<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    public $timestamps = false;

    protected $fillable = [
        'color_name',
        'code',
        'sort'
    ];

    public static function addColor($data){
        $query = DB::table('colors')->insert([
            'color_name' => $data['color_name'],
            'code' => $data['hex_code'],
            'sort' => $data['sort']
        ]);
        return $query ? true : false;
    }

    public static function getAllColor(){
        $query = DB::table('colors')->get();
        return $query;
    }

    public static function getColor(){
        
    }
}
