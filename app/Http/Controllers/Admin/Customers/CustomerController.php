<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customers\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{
    public function index(Request $request){
        $data['heading_title'] = "Customers";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Customers',
            'href' => URL::to('/admin/customer/customer')
        ];

        $data['add'] = URL::to('/admin/customer/customer-form');

        // Filter
        $data['customer_name'] = $request->query('customer_name') ?? null;
        $data['email'] = $request->query('email') ?? null;
        $data['contact'] = $request->query('contact') ?? null;
        $data['status'] = $request->query('status') ?? 1;

        $data['product_page_url'] = URL::to('/admin/customer/customer');

        return view('admin.customer.customer', $data);
    }

    public function form(){
        $data['heading_title'] = "Customers";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Customers',
            'href' => URL::to('/admin/customer/customer-form')
        ];

        $data['action'] = route('customer-save');
        $data['back'] = route('customer');

        return view('admin.customer.customer-form', $data);
    }

    public function save(Request $request){

        $validate = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:50',
            'number' => 'nullable|numeric|min:10',
            'password' => 'nullable|string|max:255',
            'confirm_password' => 'nullable|string|max:255|same:password'
        ]);

        try{
            $data = $request->all();

            // verify email 
            $verifyEmail = Customer::getCustomer($data['email']);
            if($verifyEmail){
                return redirect()->route('customer-form')->with('email_error', 'Email already exists');
            }

            // Upload image
            $file = $request->file('image'); // get files
            if(null !== $file){
                $folderPath = public_path('image/customer');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                $imageName = time() . '_' . $file->getClientOriginalName();
                $imagePath = public_path('image/customer') . $imageName;
                if (!file_exists($imagePath)) {
                    $file->move(public_path('image/customer/'), $imageName);
                }
                $data = array_replace($data, ['image' => $imageName]);
            }    
    
            $addCustomer = Customer::addCustomer($data);

            if($addCustomer){
                return redirect()->route('customer')->with('success', 'Customer created successfully!');
            }else{
                return redirect()->route('customer')->with('error', 'Customer not created successfully!');
            }

        }catch(Exception $e){
            dd($e);
        }

        
    }
}
