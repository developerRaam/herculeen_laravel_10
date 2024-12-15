<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;

    protected $table = 'size';

    public $timestamps = false;

    protected $fillable = [
        'size_name',
        'sort'
    ];

    public static function addSize($data){
        $query = DB::table('size')->insert([
            'size_name' => $data['size_name'],
            'sort' => $data['sort']
        ]);
        return $query ? true : false;
    }

    public static function getAllSize(){
        $query = DB::table('size')->get();
        return $query;
    }

    public static function getColor(){
        
    }

    
}
