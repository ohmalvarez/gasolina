<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Municipios;

/**
    Endpoint que devuelve los Municipios que 
    corresponden a un Estado determinado.
**/
class MunicipioController extends Controller
{
    public function get( Request $request )
    {
    	try {
            $municipios = Municipios::byestado( $request->toArray()['estado_id'] )->get()->toArray();
            foreach ( $municipios as $municipio ) 
                $municipiosArray[ $municipio['c_mnpio'] ] = $municipio['d_mnpio'];
            
    		return response()->json( $municipiosArray );
    	}
    	catch (\Exception $ex)
    	{
    		exit( $this->generalResponse( $ex->getMessage(), $ex->getCode() ) );
    	}
    }
    
}
