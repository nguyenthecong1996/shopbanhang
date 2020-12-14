<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TblUser extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'writer';
    protected $table = 'tbl_users';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'email',
        'password',
        'name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function TblShipping()
    {
        return $this->hasMany('App\Models\TblShipping', 'id', 'user_id');
    }
}
