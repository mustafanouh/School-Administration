<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {

        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat', compact('users'));
    }


    public function getMessages($receiverId)
    {
        $userId = auth()->id();

        if ($receiverId == 0) {
         
            return Message::whereNull('receiver_id')->with('sender')->oldest()->get();
        }


        return Message::where(function ($q) use ($userId, $receiverId) {
            $q->where('sender_id', $userId)->where('receiver_id', $receiverId);
        })->orWhere(function ($q) use ($userId, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $userId);
        })->with('sender')->oldest()->get();
    }


    public function store(Request $request)
    {
        
        $receiverId = ($request->receiver_id == 0) ? null : $request->receiver_id;

        $msg = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        return $msg;
    }
}
