<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function Register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response(status: 400);
        }

        if ($this->service->Register($request['name'], $request['email'], $request['password'])) {
            return response(status: 200);
        }
        return response(status: 422);
    }

    public function Login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response(status: 400);
        }

        $token = $this->service->Authenticate($request['email'], $request['password']);

        return $token ? response(['token' => $token]) : response(status: 401);
    }
}
