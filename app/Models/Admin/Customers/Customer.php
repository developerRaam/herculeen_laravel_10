<?php

namespace App\Models\Admin\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customers';
    
    protected $fillable = ['name','email','email_verified_at','number','number_verified_at','password','customer_group_id','status','ip'];

    public static function addCustomer($data = array()){
        if($data){
            $customer = DB::table((new self())->getTable())->insert([
                "customer_group_id" => $data['customer_group_id'] ?? 0,
                "name" => $data['customer_name'] ?? '',
                "email" => $data['email'] ?? '',
                "number" => $data['number'] ?? '',
                "password" => Hash::make($data['password']) ?? null,
                "email_verified_at" => null,
                "number_verified_at" => null,
                "status" => $data['status'] ?? 0,
                "image" => isset($data['image']) ? $data['image'] : '',
                "created_at" => now(),
                "updated_at" => now()
            ]);

            if($customer){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function updateCustomer(int $customer_id, $data = array()){
        if (!empty($data)) {
            $updateData = [
                "customer_group_id" => $data['customer_group_id'] ?? 0,
                "name" => $data['customer_name'] ?? '',
                "email" => $data['email'] ?? '',
                "number" => $data['number'] ?? '',
                "status" => $data['status'] ?? 0,
                "updated_at" => now()
            ];
    
            if (isset($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }
    
            if (isset($data['image'])) {
                $updateData['image'] = $data['image'];
            }
    
            // Perform the update
            DB::table((new self())->getTable())->where('id', $customer_id)->update($updateData);
    
            return true;
        }
        return false;
    }

    public static function getCustomerByEmail($email = null){
        $customer = DB::table((new self())->getTable())->where('email', $email)->get()->first();
        return $customer;
    }

    public static function getCustomerById($customer_id = null){
        $customer = DB::table((new self())->getTable())->where('id', $customer_id)->get()->first();
        return $customer;
    }

    public static function getCustomers($request = null){
        // Start the query using Eloquent
        $query = self::query();

        // Apply filters based on the request
        if ($request) {
            if ($request->filled('customer_name')) {
                $query->where('name', 'like', '%' . $request->query('customer_name') . '%');
            }
            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->query('email') . '%');
            }
            if ($request->filled('contact')) {
                $query->where('number', 'like', '%' . $request->query('contact') . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', $request->query('status'));
            }
        }

        // Execute the query and get the results
        return $query->get();
    }

    public static function deleteCustomer($customer_id){
        $customer = DB::table((new self())->getTable())->where('id', $customer_id)->get()->first();
        if($customer && $customer->image){
            $imageName = $customer->image;
            $imagePath = public_path('image/customer/') . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        DB::table((new self())->getTable())->where('id', $customer_id)->delete();
        return true;
    }

}
