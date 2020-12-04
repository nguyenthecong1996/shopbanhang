<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // use HasFactory;
    protected $primaryKey = 'matp'; 
    public $timestamps = true;
    protected $table = 'tbl_city';
    protected $fillable = ['matp', 'name_thanhpho', 'type'];
}
