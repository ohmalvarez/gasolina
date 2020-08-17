<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ApiDatosGob;
use App\Http\Models\Ubicaciones;

/**
    Endpoint que devuelve un array con informacion cruzada de DB
    y del enpoint del api de precios de gasolina.
**/
class GasolController extends Controller
{
    public function __construct(Request $request)
    {
        // Seteando Modelo api Gob
    	$this->apiGob = new ApiDatosGob();
    }

    public function api( Request $request )
    {
    	try
    	{
            // 1. Traer codigos postales por Estado y Municipio
			$codigos = Ubicaciones::select('d_codigo')
                ->byestado( $request->toArray()['estado'] )
                ->bymunicipio( $request->toArray()['municipio'] )
                ->groupBy('d_codigo')
                ->get()
                ->toArray();

            // 2. Cruce de info entre DB y Api
            $combine = $this->apiGob->combineInfo( $codigos );

            return response()->json( $combine );
    	}
    	catch (\Exception $ex)
    	{
    		exit( $this->generalResponse( $ex->getMessage(), false, $ex->getCode() ) );
    	}
    }

}
