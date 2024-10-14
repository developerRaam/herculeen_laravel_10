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
                "number" => $data['number'] ?? null,
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

    public static function getCustomer($email = null){

        $customer = DB::table((new self())->getTable())->where('email', $email)->get()->first();
        return $customer;
    }

}
