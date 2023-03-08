<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'id_petugas',
        'username',
        'name_petugas',
        'level'
    ];

    protected $hidden = [
        'password'
    ];
}
