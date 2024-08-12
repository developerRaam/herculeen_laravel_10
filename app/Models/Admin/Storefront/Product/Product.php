<?php

namespace App\Models\Admin\Storefront\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getProduct($product_id){
        $query = " SELECT
                p.*,
                GROUP_CONCAT(pc.category_id ORDER BY pc.category_id ASC SEPARATOR ',') AS category_ids,
                GROUP_CONCAT(pd.customer_group_id ORDER BY pd.customer_group_id ASC SEPARATOR ',') AS discount_customer_group_ids,
                GROUP_CONCAT(pi.image, pi.sort ORDER BY pi.sort ASC SEPARATOR ',') AS images,
                GROUP_CONCAT(pol.amazon ORDER BY pol.status ASC SEPARATOR ',') AS other_links_amazon,
                GROUP_CONCAT(pp.list_price ORDER BY pp.list_price ASC SEPARATOR ',') AS prices_list,
                GROUP_CONCAT(ps.customer_group_id ORDER BY ps.priority ASC SEPARATOR ',') AS special_customer_group_ids
            FROM
                products p
            LEFT JOIN
                product_categories pc ON p.id = pc.product_id
            LEFT JOIN
                product_discounts pd ON p.id = pd.product_id
            LEFT JOIN
                product_images pi ON p.id = pi.product_id
            LEFT JOIN
                product_other_links pol ON p.id = pol.product_id
            LEFT JOIN
                product_prices pp ON p.id = pp.product_id
            LEFT JOIN
                product_specials ps ON p.id = ps.product_id
            WHERE
                p.id = :product_id
            GROUP BY
                p.id limit 1
        ";

        return DB::select($query, ['product_id' => $product_id])[0] ?? null;
    }

    public static function getProducts($request = null){
        $query = 'SELECT p.id as product_id,pi.image, p.product_name, p.model, pp.list_price, pp.mrp, p.quantity FROM  products p LEFT JOIN product_images pi ON p.id = pi.product_id LEFT JOIN  product_prices pp ON pp.product_id = p.id  WHERE 1=1';

        // Filter
        if (null !== $request->query('product_name')) {
            $query .= ' AND p.product_name=' . "'" . $request->query('product_name') . "'";
        }
        if (null !== $request->query('model')) {
            $query .= ' AND p.model=' . "'" . $request->query('model') . "'";
        }
        if (null !== $request->query('price')) {
            $query .= ' AND pp.list_price=' . "'" . $request->query('price') . "'";
        }
        if (null !== $request->query('quantity')) {
            $query .= ' AND  p.quantity=' . "'" . $request->query('quantity') . "'";
        }
        if (null !== $request->query('product_name')) {
            $query .= ' AND status=' . "'" . $request->query('status') . "'";
        }

        return DB::select($query);
    }

    public static function deleteProduct($product_id){
        Product::where('id', $product_id)->delete();
        ProductCategory::where('product_id', $product_id)->delete();
        ProductPrice::where('product_id', $product_id)->delete();
        ProductDiscount::where('product_id', $product_id)->delete();
        ProductSpecial::where('product_id', $product_id)->delete();
        ProductDownload::where('product_id', $product_id)->delete();
        ProductReward::where('product_id', $product_id)->delete();
        ProductFilter::where('product_id', $product_id)->delete();
        ProductImage::where('product_id', $product_id)->delete();
        ProductOtherLink::where('product_id', $product_id)->delete();
        return true;
    }
}
