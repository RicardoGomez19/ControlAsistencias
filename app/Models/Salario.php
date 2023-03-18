<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    // use HasFactory;

    protected $table='salarios';

    protected $primaryKey='id';

    public $with = ['puestos'];
    
    public $incrementing=true;

    public $timestamps=true;

    public $fillable=[
        'anio',
        'mes',
        'valor',
        'fecha_inicio',
        'fecha_fin',
        'id_puesto'
    ];

    public function puestos()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto', 'id_puesto');
    }
    
}




