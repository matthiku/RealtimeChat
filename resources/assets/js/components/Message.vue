<template>
    <div>
      <li class="list-group-item" :class="className"> {{ message.text }}
        <small class="badge float-right" :class="badgeClass">{{ message.user.name }}
          <span class="show-msg-time">{{ message.time }}</span>
        </small>
      </li>
    </div>
</template>

<script>
  export default {
    props: [
      'message',
    ],
    computed: {
      className() {
        return 'list-group-item-'+this.message.color;
      },
      badgeClass() {
        return 'badge-'+this.message.color;
      },
    },
    mounted() {
    },
  }
</script>

<style>
  .show-msg-time {
    color: black;
    vertical-align: super;
    font-size: x-small;
  }
</style>
