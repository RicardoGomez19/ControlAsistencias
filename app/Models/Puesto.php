<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table="puestos";

    protected $primaryKey="id_puesto";

    public $incrementing=true;

    public $timestamps=true;

    protected $fillable=[
        
        'puesto'
    ];

}
