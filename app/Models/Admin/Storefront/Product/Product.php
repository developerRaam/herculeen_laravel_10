<?php

namespace App\Models\Admin\Storefront\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // Define the fillable attributes
    protected $fillable = [
        'product_name',
        'product_description',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'model',
        'sku',
        'upc',
        'ean',
        'jan',
        'isbn',
        'mpn',
        'quantity',
        'minimum',
        'subtract',
        'stock_status_id',
        'date_available',
        'shipping',
        'length',
        'width',
        'height',
        'length_class_id',
        'weight',
        'weight_class_id',
        'status',
        'sort_order'
    ];
}
