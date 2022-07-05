<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    public function GetMessages() {
        return Message::orderBy("created_at", "desc")->paginate(20);
    }

    public function Upload(string $message) {
        $user = Auth::user();
        Message::create([
            "content" => $message,
            "user_id" => $user->id
        ]);
        return true;
    }

    public function Delete(int $id) {
        $user = Auth::user();
        $message = Message::whereId($id);
        if (!$message->exists() || $message->first()->user_id != $user->id) {
            return false;
        }
        $message->delete();
        return true;
    }
}
