<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
    use HasFactory;


    protected $table="status";

    protected $primaryKey="id_statu";

    public $incrementing=true;

    public $timestamps=true;

    protected $fillable=[ 
        'statu'
    ];

}
