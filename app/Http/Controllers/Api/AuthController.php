<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            $user = User::create($request->validated());
            return new UserResource($user);
        } catch(QueryException $e) {
            if(str_contains($e->getMessage(), 'Duplicate email')) {
                return response()->json([
                    'message' => 'User with this email already exists'
                ], 409);
            }
            Log::error('User registration failed', [
                'error' => $e->getMessage(),
                'input' => $request->except('password')
            ]);

            return response()->json([
                'message' => 'Registration failed'
            ], 500);
        } catch(\Throwable $throwable) {
            Log::error('User registration failed', [
                'error' => $throwable->getMessage(),
            ]);
            return response()->json([
                'message' => 'Registration failed'
            ]);
        }
        
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        try {
            if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'unauthorized'
            ], 401);
            }

            return response()->json([
                'user' => auth('api')->user(),
                'token' => $token,
            ], 200);
        } catch(\Throwable $throwable) {
            Log::error('Login canceled', [
                'error' => $throwable->getMessage()
            ]);

            return response()->json([
                'error' => 'Failed login'
            ], 500);
        }
    }

        public function logout()
        {
            try{
                JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json([
                    'message' => 'User has been logged out'
                ], 200);
            } catch (\Throwable $throwable) {
                return response()->json([
                    'error' => 'Failed to logout'
                ]);
            }    
        }
    }
