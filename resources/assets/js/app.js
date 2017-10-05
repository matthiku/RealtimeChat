
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';

/* install vue chat scroll (https://github.com/theomessin/vue-chat-scroll) */
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);

/* v-toaster (https://github.com/paliari/v-toaster) */
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
Vue.use(Toaster, { timeout: 5000 });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('message', require('./components/Message.vue'));
Vue.component('show-users', require('./components/ShowUsers.vue'));

const app = new Vue({
    el: '#app',
    data: {
      message: '',
      chat: [],
      user: [],
      typing: '',
      members: [],
    },

    methods: {
      send() {
        if (this.message) {
          axios.post('/send', {
            message: this.message,
          })
          .then(response => {
            this.chat.push({
              text: this.message,
              user: this.user,
              color: 'success',
              time: this.getTime(),
            });
            this.saveChatToSession();
            this.message = '';
          })
          .catch(error => {
            console.log(error);
          });
        }
      },

      forgetChat() {
        axios.post('/forgetChat')
          .then(response => {
            this.$toaster.success('Chat history deleted.');
          })
          .catch(error => {
            console.error(error);
          });
      },

      getOldMessages() {
        axios.post('/getOldMessages')
          .then(response => {
            console.log(response.data);
            if (typeof response.data == 'object') {
              this.chat = response.data;
            }
          })
          .catch(error => {
            console.error(error);
          });
      },

      saveChatToSession() {
        axios.post('/saveToSession', {
            chat: this.chat,
          })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.error(error);
          });
      },

      getTime() {
        let time = new Date();
        return time.getHours() + ':' + time.getMinutes();
      },
    },

    watch: {
      message() {
        Echo.private('chat')
        .whisper('typing', {
          text: this.message,
          name: this.user.name,
        });
      },
    },

    mounted() {
      this.getOldMessages();

      //do something after mounting vue instance
      this.user = laraRTchat.user;

      Echo.private('chat')
        .listen('ChatEvent', (e) => {
          this.chat.push({
            text: e.message,
            user: e.user,
            color: 'info',
            time: this.getTime(),
          });
          this.saveChatToSession();
        })
        .listenForWhisper('typing', (e) => {
          if (e.text) {
            this.typing = e.name + ' is typing...';
          } else {
            this.typing = '';
          }
        });

      Echo.join('chat')
        .here((users) => {
            this.members = users;
          })
        .joining((user) => {
          this.members.push(user);
          this.$toaster.success(user.user.name + ' joined the chat room');
        })
        .leaving((user) => {
          this.$toaster.error(user.user.name + ' left the chat room');
          var leaving = user.user;
          this.members = this.members.filter((val) => {
            return val.user.id != leaving.id;
          });
        });
    },
  });
