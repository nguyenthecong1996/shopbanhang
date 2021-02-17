<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    protected $table = 'roles';
    protected $fillable = ['id', 'role_status'];

    public function admin()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
