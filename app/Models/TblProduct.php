<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblProduct extends Model
{
    // use HasFactory;
    public $timestamps = true;
    protected $table = 'tbl_products';
    protected  $primaryKey = 'product_id';
    protected $fillable = ['category_id', 'product_id ', 'brand_id', 'product_name', 'product_desc', 'product_content', 'product_image','product_price', 'product_status', 'product_qty'];

    public function CategoryProduct()
    {
        return $this->belongsTo('App\Models\TblCategory', 'category_id', 'category_id');
    }

    public function Brand()
    {
        return $this->belongsTo('App\Models\TblBrand', 'brand_id', 'brand_id');
    }
}
