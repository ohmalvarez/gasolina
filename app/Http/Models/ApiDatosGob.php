<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use App\Http\Models\Ubicaciones;

/**
Modelo de que consume api del Gob Mexa de precios de gasoleo.
Obtiene la informacion completa y trata los datos para mostrar
en el front en un tabla dinamica y lo geolocaliza en maps.
**/
class ApiDatosGob extends Model
{
    // Consumo del api gob
    public function get()
    {
		$url = env('API_GAS_GOB');

        // Utilizando libreria Guzzle
    	$client = new Client( [ 'base_uri' => $url ] );

    	// /v1/precio.gasolina.publico 						<- original
    	// /v1/precio.gasolina.publico?page=3				<- x num pagina
    	// /v1/precio.gasolina.publico?pageSize=10100		<- x total pagina
    	$response = $client->request('GET', '/v1/precio.gasolina.publico?pageSize=10100');

    	$data = json_decode( $response->getBody() );
    	//gettype($data);// object

    	return $data->results;
    }

    // Correlaciona informacion de DB con datos obtenidos x api
    public function combineInfo ( Array $codigos )
    {
        $combineResult = [];
        $ubicacionesApi = $this->get();

    	foreach ( $codigos as $item => $codigo ) {
    		$registro = Ubicaciones::bycodigo( $codigo['d_codigo'] )->first()->toArray();
    		$codigosP[] = $codigo['d_codigo'];
    		$codigosInfo[ $codigo['d_codigo'] ][ 'd_estado' ] = $registro['d_estado'];
    		$codigosInfo[ $codigo['d_codigo'] ][ 'd_mnpio' ] = $registro['d_mnpio'];
    	}

        foreach ( $ubicacionesApi as $ubicacion ) {
        	if ( in_array( $ubicacion->codigopostal, $codigosP ) ) {
        		$combineResult[] = array (
        			'id' => $ubicacion->_id,
	        		'rfc' => $ubicacion->rfc,
	        		'razonsocial' => $ubicacion->razonsocial,
	        		'date_insert' => $ubicacion->date_insert,
	        		'numeropermiso' => $ubicacion->numeropermiso,
	        		'fechaaplicacion' => $ubicacion->fechaaplicacion,
	        		'﻿permisoid' => $ubicacion->﻿permisoid,
	        		'longitude' => $ubicacion->longitude,
	        		'latitude' => $ubicacion->latitude,
	        		'codigopostal' => $ubicacion->codigopostal,
        			'calle' => $ubicacion->calle,
	        		'colonia' => $ubicacion->colonia,
	        		'municipio' => $codigosInfo[ $ubicacion->codigopostal ][ 'd_mnpio' ],
	        		'estado' => $codigosInfo[ $ubicacion->codigopostal ][ 'd_estado' ],
	        		'regular' => $ubicacion->regular,
	        		'premium' => $ubicacion->premium,
	        		'dieasel' => $ubicacion->dieasel,
	        	);
        	}

        }

        return $combineResult;
    }
}
