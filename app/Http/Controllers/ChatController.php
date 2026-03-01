<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // عرض واجهة الشات مع قائمة المستخدمين
    public function index()
    {
        // جلب كل المستخدمين ما عدا المستخدم الحالي
        $users = User::where('id', '!=', auth()->id())->get();
        return view('chat', compact('users'));
    }

    // جلب الرسائل بين المستخدم الحالي ومستخدم آخر
    public function getMessages($receiverId)
    {
        $userId = auth()->id();

        if ($receiverId == 0) {
            // جلب رسائل المجموعة
            return Message::where('receiver_id', 0)->with('sender')->oldest()->get();
        }

        // جلب الرسائل الثنائية
        return Message::where(function ($q) use ($userId, $receiverId) {
            $q->where('sender_id', $userId)->where('receiver_id', $receiverId);
        })->orWhere(function ($q) use ($userId, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $userId);
        })->with('sender')->oldest()->get();
    }

    // حفظ وإرسال الرسالة (الكود الخاص بك مع إضافة النوع)
    public function store(Request $request)
    {
        $msg = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id, // ستكون قيمتها 0 في حال الجماعي
            'message' => $request->message
        ]);

        // تأكد من تمرير الموديل بالكامل للحدث
        broadcast(new \App\Events\MessageSent($msg))->toOthers();

        return $msg;
    }
}
