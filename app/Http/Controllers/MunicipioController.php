<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Municipios;
use App\Http\Models\Estados;

/**
    Endpoint que devuelve los Municipios que 
    corresponden a un Estado determinado.
**/
class MunicipioController extends Controller
{
    public function get( Request $request )
    {
    	try {
            $estadoId = $request->toArray()['estado_id'];

            $municipios = Municipios::byestado( $estadoId )->get()->toArray();
            $estadoFullInfo = Estados::byestadofullinfo( $estadoId )->get()->toArray();

            foreach ( $municipios as $municipio ) 
                $municipiosArray["mnpios"][ $municipio['c_mnpio'] ] = $municipio['d_mnpio'];
            
            $municipiosArray["estado"] = $estadoFullInfo[0];
            //dd( $municipiosArray );
    		return response()->json( $municipiosArray );
    	}
    	catch (\Exception $ex)
    	{
    		exit( $this->generalResponse( $ex->getMessage(), $ex->getCode() ) );
    	}
    }
    
}
