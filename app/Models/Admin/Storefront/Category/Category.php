<?php

namespace App\Models\Admin\Storefront\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getCategory($category_id = null)
    {
        $query = "WITH RECURSIVE CategoryHierarchy AS (
            SELECT id, category_name, description, image, sort_order, status, parent_id, category_name AS full_path, 1 AS level 
            FROM category
            WHERE parent_id IS NULL
            UNION ALL
            SELECT c.id, c.category_name, c.description, c.image, c.sort_order, c.status, c.parent_id, CONCAT(ch.full_path, ' > ', c.category_name) AS full_path, ch.level + 1 AS level
            FROM category c
            INNER JOIN CategoryHierarchy ch ON c.parent_id = ch.id) 
            SELECT * FROM CategoryHierarchy ";

        if(empty($category_id)){
            return DB::select($query. 'ORDER BY full_path ASC');
        }else{
            DB::select($query.' WHERE id ="'.$category_id.'"')[0];
        }
    }
}
