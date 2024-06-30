<?php

namespace App\Models\Admin\Storefront\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product_categories';

    protected $fillable = [
        'product_id',
        'category_id'
    ];
}
