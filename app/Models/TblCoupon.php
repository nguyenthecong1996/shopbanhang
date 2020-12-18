<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblCoupon extends Model
{
    use HasFactory;
    protected $primaryKey = 'coupon_id'; 
    public $timestamps = true;
    protected $table = 'tbl_coupons';
    protected $fillable = ['coupon_id','coupon_name', 'coupon_code', 'coupon_number', 'coupon_condition', 'coupon_time'];
}
