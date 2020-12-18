<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOrder extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tbl_orders';
    protected  $primaryKey = 'order_id';
    protected $fillable = ['user_id', 'order_total', 'payment_status', 'order_status'];

    public function TblUser()
    {
        return $this->belongsTo('App\Models\TblUser', 'user_id', 'id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\TblShipping', 'shipping_id', 'shipping_id');
    }

    public function orderDetail()
    {
        return $this->hasMany('App\Models\TblOrderDetail', 'order_id', 'order_id');
    }
}
