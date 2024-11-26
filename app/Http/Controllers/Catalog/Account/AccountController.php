<?php

namespace App\Http\Controllers\Catalog\Account;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class AccountController extends Controller
{
    public function index(){
        $data['login'] = route('catalog.user-login-account');
        $data['register'] = route('catalog.user-register');
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
                    return redirect()->route('catalog.front-user-dashboard');
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
            self::sendOTP($data->get('email'));

            Session::put('register_data', $data);

            return redirect()->route('catalog.verifyOtpPage');
        
        }catch(Exception $e){
            dd($e->getMessage());
        }

    }

    public function verifyOtpPage(){ 
        $data['action'] = route('catalog.verifyOTP');

        $getSessionOtp = Session::get('email_otp');

        if($getSessionOtp){
            return view('catalog.account.verify_otp', $data);
        }else{
            return redirect()->route('catalog.user-login');
        }
    }

    public function sendOTP($email){
        $otp = rand(100000, 999999);

        // send mail
        $emailArray = [
            "subject" => "Registration OTP",
            "email_otp" => $otp
        ];
        Mail::to($email)->send(new Email($emailArray));

        Session::put('email_otp', $otp);
    }

    public function verifyOTP(Request $request){
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

    public function logout(){
        session()->forget('isCustomer');
        session()->forget('customer_name');
        return redirect()->route('catalog.user-login')->with('success', 'Logout');
    }
}
