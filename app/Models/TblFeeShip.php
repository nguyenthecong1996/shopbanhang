<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblFeeShip extends Model
{
    // use HasFactory;
    protected $primaryKey = 'fee_id'; 
    public $timestamps = true;
    protected $table = 'tbl_fee_ships';
    protected $fillable = ['fee_id', 'fee_maxp', 'fee_matp', 'fee_maqh', 'fee_feesship'];

    public function City()
    {
        return $this->belongsTo('App\Models\City', 'fee_matp', 'matp');
    }

    public function Provice()
    {
        return $this->belongsTo('App\Models\Provice', 'fee_maqh', 'maqh');
    }

    public function Wards()
    {
        return $this->belongsTo('App\Models\Wards', 'fee_maxp', 'xaid');
    }
}
