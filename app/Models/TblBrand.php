<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBrand extends Model
{
    // use HasFactory;
    protected $primaryKey = 'brand_id'; 
    public $timestamps = true;
    protected $table = 'tbl_brands';
    protected $fillable = ['brand_id', 'brand_name', 'brand_desc', 'brand_status'];
}
