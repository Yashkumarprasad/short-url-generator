<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('auth:admin')->only('logout');
    }

    public function index()
    {
        if (Auth::guard('admin')->user()) {
            return redirect()->route('admin.dashboard');
        }

        $title = 'Admin Login';
        return view('admin.auth.login', compact('title'));
    }
    public function loginSubmit(Request $request)
    {
        $check_user = User::where('email', $request->email)->where(function ($query) {
            $query->whereIn('user_type', [SUPER_ADMIN, ADMIN, MEMBER]);
        })->first();
        if (!is_null($check_user)) {

            $credentials = array('email' => $request->email, 'password' => $request->password, 'id' => $check_user->id);
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in');
            }

            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
