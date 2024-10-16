<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Admin\Common\Pagination;
use App\Http\Controllers\Controller;
use App\Models\Admin\Customers\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $data['page_url'] = route('customer');

        // Pagination
        $results = Customer::getCustomers($request);
        $perPage = 50;
        $paginator = Pagination::pagination($results, $perPage);
        $data['customers'] = $paginator['items'];
        $data['pagination'] = $paginator['pagination'];


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

        $data['states'] = DB::table('state')->get();
        $data['countries'] = DB::table('country')->get();

        return view('admin.customer.customer-form', $data);
    }

    public function edit($customer_id = null){
        $data['heading_title'] = "Customers";

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => 'Home',
            'href' => URL::to('/admin/dashboard')
        ];
        $data['breadcrumbs'][] = [
            'text' => 'Customers',
            'href' => URL::to('/admin/customer/customer/')
        ];

        $data['breadcrumbs'][] = [
            'text' => 'Edit Customer',
            'href' => URL::to('/admin/customer/customer-edit/customer_id='.$customer_id)
        ];

        $data['action'] = route('customer-save', ['customer_id' => $customer_id]);
        $data['back'] = route('customer');

        if($customer_id){
            $data['customer'] = Customer::getCustomerById($customer_id);
        }

        $data['states'] = DB::table('state')->get();
        $data['countries'] = DB::table('country')->get();

        return view('admin.customer.customer-form', $data);
    }

    public function save(Request $request, $customer_id = null){

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
            if($customer_id){
                $getCustomer = Customer::getCustomerById($customer_id);
                if($getCustomer->email !== $data['email']){
                    $verifyEmail = Customer::getCustomerByEmail($data['email']);
                    if($verifyEmail){
                        return redirect()->route('customer-form', $customer_id)->with('email_error', 'Email already exists');
                    }
                }
            }else{
                $verifyEmail = Customer::getCustomerByEmail($data['email']);
                if($verifyEmail){
                    return redirect()->route('customer-form')->with('email_error', 'Email already exists');
                }
            }

            // Upload image
            $file = $request->file('image'); // get files
            if(null !== $file){
                // remove image before update
                $getCustomer = Customer::getCustomerById($customer_id);
                if($getCustomer && $getCustomer->image){
                    $image_name = isset($getCustomer->image) ? $getCustomer->image : null;
                    if($image_name){
                        if(file_exists(public_path('image/customer/') . $image_name)){
                            unlink(public_path('image/customer/') . $image_name);
                        }
                    }
                }
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

            if($customer_id){
                Customer::updateCustomer($customer_id, $data);
                return redirect()->route('customer')->with('success', 'Customer updated successfully!');
            }else{
                Customer::addCustomer($data);
                return redirect()->route('customer')->with('success', 'Customer created successfully!');
            }
        }catch(Exception $e){
            dd($e);
        }        
    }

    public function delete($customer_id){
        $deleteCustomer = Customer::deleteCustomer($customer_id);
        if($deleteCustomer){
            return redirect()->route('customer')->with('success', 'Customer deleted successfully!');
        }else{
            return redirect()->route('customer')->with('error', 'Customer not deleted successfully!');
        }
    }

    public function deleteMultiSelection(Request $request){
        $customerList = $request->input('customerList');
        if($customerList){
            foreach ($customerList as $value) {
                $customer_id = (int)$value;
                Customer::deleteCustomer($customer_id);
            }
            $json = [
                'success' => 1,
                'message' => "Customer deleted successfully"
            ];
            return response()->json($json);
        }else{
            $json = [
                'error' => 1,
                'message' => "You must select a customer to delete."
            ];
            return response()->json($json);
        }
    }
}
