<?php

namespace App\Http\Controllers\Catalog\Account;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class LoginController extends Controller
{
    public function index(){
        $data['login'] = route('catalog.user-login-account');
        $data['register'] = route('catalog.user-register');
        $data['forgot_password'] = route('catalog.viewForgotPassword');
        return view('catalog.account.login', $data);
    }

    public function login(Request $request){
        $customer = DB::table('customers')->where('email', $request->request->get('email'))->first();
        if ($customer) {
            $password = $request->request->get('password');
            $hashedPassword = Hash::check($password, $customer->password);
            if($hashedPassword){
                if ($customer->status) {
                    $request->session()->put('isCustomer', $customer->id);
                    $request->session()->put('customer_name',$customer->name);
                    return redirect()->route('catalog.front-user-account');
                } else {
                    return redirect()->route('catalog.user-login')->with('error', 'Account disabled. Please contact Admin.');
                }
            }else{
                return redirect()->route('catalog.user-login')->with('error', 'Username and password do not match.');
            }
        } else {
            return redirect()->route('catalog.user-login')->with('error', 'Username and password do not match.');
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:4|max:20',
            'confirm_password' => 'required|string|min:4|max:20'
        ]);
        if ($validator->fails()) {
            return redirect('/account/login#register')
            ->withErrors($validator)
            ->withInput()
            ->with('registerError', 'registerError');
        }

        try{
            $data = $request->request;

            // checking password
            if($data->get('password') !== $data->get('confirm_password')){
                return redirect('/account/login#register')->with('password_not_match', 'The password does not match.');
            }

            // checking email
            $getRegister = DB::table("customers")->where('email', $data->get('email'))->first();
            if($getRegister){
                return redirect()->route('catalog.user-login')->with('email_error', 'Email already exists.')->with('registerError', 'registerError');;
            }

            // send mail for otp
            $subject = 'Registration OTP';
            $email = $data->get('email');
            $otp = rand(100000, 999999);
            self::sendMail($email, $subject, null, $otp, null);

            Session::put('register_data', $data);

            return redirect()->route('catalog.verifyOtpPage');
        
        }catch(Exception $e){
            dd($e->getMessage());
        }

    }

    public function viewForgotPassword(){
        $data['action'] = route('catalog.forgotPassword');
        return view('catalog.account.forgot-password', $data);
    }

    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:50',
        ]);
        if ($validator->fails()) {
            return redirect()->route('catalog.viewForgotPassword')->withErrors($validator)->withInput();
        }

        try{
            $data = $request->request;
            // verify email
            $getEmail = DB::table('customers')->where('email', $data->get('email'))->first();
            if($getEmail){
                $user_token = Str::random(60);    
                // send mail for otp
                $subject = 'Click to reset your password';
                $text = "Reset Password";
                $email = $data->get('email');
                $url = route('catalog.viewResetPassword') . '/' . $user_token;
                self::sendMail($email, $subject, $text, null, $url);
                Session::put('user_token', $user_token);
                Session::put('user_email', $email);
                return redirect()->route('catalog.viewForgotPassword')->with('success', "Email sent successfully! Please check email and reset password.");
            }
            return redirect()->route('catalog.viewForgotPassword')->with('email_not_match', 'Email does not exists.');

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function viewResetPassword($user_token = null){
        $session_user_token = session('user_token');
        
        if(!$session_user_token){
            return redirect()->route('catalog.user-login')->with('error', 'Session expired');
        }

        if($session_user_token !== $user_token){
            return redirect()->route('catalog.user-login')->with('error', 'Session expired');
        }
        $data['action'] = route('catalog.resetPassword');
        return view('catalog.account.reset-password', $data);
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:4|max:20',
            'confirm_password' => 'required|string|min:4|max:20',
        ],[
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 4 characters.',
            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.min' => 'The confirm password must be at least 4 characters.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('catalog.viewResetPassword', ['user_token' => session('user_token')])->withErrors($validator)->withInput();
        }
        
        // dd($request->request);
        try{
            $data = $request->request;

            // checking password
            if($data->get('password') !== $data->get('confirm_password')){
                return redirect()->route('catalog.viewResetPassword',['user_token' => session('user_token')])->with('password_not_match', 'The password does not match.');
            }

            DB::table('customers')->where('email', session('user_email'))->update([
                "password" => Hash::make($data->get('password'))
            ]);

            session()->forget('email_otp');
            session()->forget('user_token');
            session()->forget('user_email');

            return redirect()->route('catalog.user-login')->with('success', "Password reset successfully!");

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function logout(){
        session()->forget('isCustomer');
        session()->forget('customer_name');
        return redirect()->route('catalog.user-login')->with('success', 'Logout');
    }

    public function verifyOtpPage(){ 
        $data['action'] = route('catalog.registeredUserData');

        $getSessionOtp = Session::get('email_otp');

        if($getSessionOtp){
            return view('catalog.account.verify_otp', $data);
        }else{
            return redirect()->route('catalog.user-login');
        }
    }

    public function sendMail($email, $subject, $text=null, $otp=null, $url=null){
        // send mail
        $emailData = [
            "subject" => $subject,
            "text" => $text,
            "email_otp" => $otp,
            "url" => $url
        ];
        Session::put('email_otp', $otp);
        Mail::to($email)->send(new Email($emailData));

    }

    public function registeredUserData(Request $request){
        $getSessionOtp = Session::get('email_otp');
        $getOtp = (int) $request->request->get('otp');

        // verifying otp
        if($getOtp !== $getSessionOtp){
            return redirect()->route('catalog.verifyOtpPage')->with('error', 'The OTP you entered is incorrect. Please check your email and try again.');
        }

        $data = Session::get('register_data');

        $register = DB::table('customers')->insert([
            "name" => $data->get('name'),
            "email" => $data->get('email'),
            "email_verified_at" => now(),
            "password" => Hash::make($data->get('password')),
            "status" => 1
        ]);

        session()->forget('email_otp');
        session()->forget('register_data');

        if($register){
            return redirect()->route('catalog.user-login')->with('success', 'Congratulations! Your registration was successful. You can now log in to your account.!');
        }else{
            return redirect()->route('catalog.user-login')->with('success', 'Oops! Something went wrong. Please check the form and try again.');
        }
    }
}
