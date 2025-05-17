<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home'; // Дефолтный путь

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.index');
        }
        return '/api/login';
    }

    // Переопределяем credentials для безопасности
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }
}
