<?php

namespace App\Http\Controllers\Admin\Common;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.common.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // $hashed=Hash::make($request->password);
        // dd($hashed);
        // Hash::check($request->password,$admin->password);
        $hashedPassword = hash('sha256', $request->password);

        $admin = Admin::where('username', $request->username)
            ->where('password', $hashedPassword)
            ->first();

        if ($admin) {
            if ($admin->status) {
                $request->session()->put('admin_id', $admin->id, 'name',$admin->name);
                return redirect()->route('admin-dashboard');
            } else {
                return redirect()->route('admin-login')->with('error', 'Account disabled. Please contact admin.');
            }
        } else {
            return redirect()->route('admin-login')->with('error', 'Username and password do not match.');
        }
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
        return redirect()->route('admin-login')->with('success', 'Logout');
    }
}
