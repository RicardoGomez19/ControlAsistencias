<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = true;

    public $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'status'
    ];

}
