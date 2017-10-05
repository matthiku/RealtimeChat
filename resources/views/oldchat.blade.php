<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style media="screen">
      .overflow-scroll {
        overflow-y: auto;
        height: 400px;
        background-color: #ccc;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <div class="row justify-content-center" id="app">
        <ul class="list-group col-4">
          <li class="list-group-item active">Chat Room</li>

          <div class="overflow-scroll" v-chat-scroll>
            <message
              v-for="value in chat.message"
              :key=value.index
              color="warning"
            >@{{ value }}</message>
          </div>

          <input type="text" class="form-control" placeholder="Type your message here...."
            v-model="message"
            @keyup.enter="send"
            >
        </ul>
      </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
  </body>

</html>
