<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $table = "c_estados";
    public $timestamps = false;

    // Obtener Municipios x estados_id
    public function scopeByestadofullinfo( $query, $type ){
        return $query->where( 'estados_id', $type );
    }
}
