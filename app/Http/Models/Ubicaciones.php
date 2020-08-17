<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

/*
    Por la premura agregue todos los registros del archivo de
    Sepomex en una tabla. La idea era generar una vista y normalizar
    dicha tabla para evitar repetir datos.
*/
class Ubicaciones extends Model
{
    protected $table = "t_ubicaciones";
    public $timestamps = false;

    // Eloquent ORM scopes para consultas agiles

    // Ubicacion x clave estado
    public function scopeByestado( $query, $type ){
        return $query->where( 'c_estado', $type );
    }

    // Ubicacion x clave municipio
    public function scopeBymunicipio( $query, $type ){
        return $query->where( 'c_mnpio', $type );
    }

    // Ubicacion x codigo postal
    public function scopeBycodigo( $query, $type ){
        return $query->where( 'd_codigo', $type );
    }
}
