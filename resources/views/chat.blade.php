@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center" id="app">
    <ul class="list-group col-xl-5 col-lg-6 col-md-8 col-sm-10 col-xs-12">
      <li class="list-group-item active">Chat Room <span class="badge badge-danger">@{{ members.length }}</span>
        <div v-show="chat.length" class="btn btn-sm btn-outline-warning mt-1 float-right"
          style="cursor: pointer"
          @click="forgetChat"
          >Delete Chat</div>
        <br>
        <show-users :members=members></show-users>
      </li>

      <div class="badge badge-pill badge-info">@{{ typing }}</div>

      <div class="overflow-scroll" v-chat-scroll>
        <message
          v-for="value,index in chat"
          :key=value.index
          :message=value
        ></message>
      </div>

      <input type="text" class="form-control" placeholder="Type your message here...."
        v-model="message"
        @keyup.enter="send"
        >
    </ul>
  </div>
</div>
@endsection
