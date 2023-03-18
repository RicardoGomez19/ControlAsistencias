<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table="historials";

    protected $primaryKey='id_historial';

    public $incrementing=true;

    public $timestamps=true;

    public $with=['empleados', 'status', 'Salarios'];

    public $fillable=[
        'folio',
        'id_puesto',
        'id_statu',
        'fecha_entrada',
        'hora_entrada',
        'hora_salida',
        'totalhr',
        'id'
    ];
    
    public function empleados()
    {
        //return $this->hasMany(Empleado::class, 'folio', 'folio');
        return $this->belongsTo(Empleado::class, 'folio', 'folio');
    }

    public function Status(){
        return $this->belongsTo(Statu::class, 'id_statu', 'id_statu');
    }

    public function salarios()
    {
        return $this->belongsTo(Salario::class, 'id', 'id');
    }
    
}
