<?php

namespace App\Http\Controllers;

use Auth;
use App\Events\ChatEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{

  /**
   * let only authorized users get access to the chat
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }


  public function chat()
  {
    return view('chat');
  }


  public function send(Request $request)
  {
    $user = Auth::user();
    event(new ChatEvent($request->message, $user));
  }


  public function saveToSession(Request $request)
  {
    session()->put('chat', $request->chat);
  }


  public function getOldMessages()
  {
    return session('chat');
  }


  public function forgetChat()
  {
    session()->forget('chat');
  }
}
