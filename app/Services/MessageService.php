<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    public function Upload(string $message) {
        $user = Auth::user();
        Message::create([
            "content" => $message,
            "user_id" => $user->id
        ]);
        return true;
    }
}
