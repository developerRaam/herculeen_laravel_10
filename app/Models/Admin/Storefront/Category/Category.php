<?php

namespace App\Models\Admin\Storefront\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category';

    protected $fillable = [
        'category_name',
        'parent_id',
        'description',
        'meta_tag',
        'image',
        'sort_order',
        'status'
    ];
}
