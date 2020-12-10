<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    // use HasFactory;
    protected $primaryKey = 'xaid'; 
    public $timestamps = true;
    protected $table = 'tbl_wards';
    protected $fillable = ['name_xa', 'xaid', 'type', 'maqh'];

    public function Provice()
    {
        return $this->belongsTo('App\Models\Provice', 'maqh', 'maqh');
    }
}
