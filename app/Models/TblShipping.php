<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblShipping extends Model
{
    // use HasFactory;
    protected $primaryKey = 'shipping_id'; 
    public $timestamps = true;
    protected $table = 'tbl_shippings';
    protected $fillable = ['shipping_id', 'shipping_name', 'shipping_email', 'shipping_address', 'shipping_phone', 'shipping_content'];
}
