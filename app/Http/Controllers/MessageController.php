<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    private MessageService $service;

    public function __construct(MessageService $authService)
    {
        $this->service = $authService;
    }

    public function UploadMessage(Request $request) {
        $validator = Validator::make($request->all(), [
            'message' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response(status: 400);
        }

        if ($this->service->Upload($request['message'])) {
            return response(status: 200);
        }
        return response(status: 422);
    }
}
