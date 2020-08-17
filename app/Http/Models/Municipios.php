<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = "c_municipios";
    public $timestamps = false;

    // Obtener Municipios x estados_id
    public function scopeByestado( $query, $type ){
        return $query->where( 'estados_id', $type );
    }
}
