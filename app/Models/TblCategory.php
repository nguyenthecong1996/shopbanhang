<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblCategory extends Model
{
    // use HasFactory;
    protected $primaryKey = 'category_id'; 
    public $timestamps = true;
    protected $table = 'tbl_categories';
    protected $fillable = ['category_id', 'category_name', 'category_desc', 'category_status'];
}
