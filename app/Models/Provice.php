<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provice extends Model
{
    // use HasFactory;
    protected $primaryKey = 'maqh'; 
    public $timestamps = true;
    protected $table = 'tbl_provice';
    protected $fillable = ['maqh', 'name_quanhuyen', 'type', 'matp'];

    public function Wards()
    {
        return $this->hasMany('App\Models\Wards', 'maqh', 'maqh');
    }
}
