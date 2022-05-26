<?php

namespace App\Services;
use App\Http\Models\Estados;

/*
	Service que llena el select de Estados
*/
class Estadosget
{
	public function get()
	{
		try{
			$estados = Estados::get();
			foreach ( $estados as $estado )
                if ( $estado->active )
				    $estadosArray[ $estado->id ] = $estado->d_estado;

			return $estadosArray;
		} catch(\Exception $ex) {
			exit( $ex->getCode() . ": " . $ex->getMessage() );
		}
	}
}
