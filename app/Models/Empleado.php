<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    // use HasFactory;

    protected $table='empleados';

    protected $primaryKey='folio';

    public $with=['puestos'];

    public $incrementing=false;

    public $timestamps=true;

    public $fillable=[
        'folio',
        'nombre',
        'apellido_p',
        'apellido_m',
        'telefono',
        'imagen',
        'password',
        'id_puesto',
        'status'
    ];

    
    public function puestos()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto','id_puesto');
    }

}
