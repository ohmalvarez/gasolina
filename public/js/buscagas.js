$(document).ready( function (){

    // Queremos que  al cambiar el option del estado, muestre los municipios que le pertenecen
    $('#estado').on('change', function(){
        var estado_id = $(this).val()
        if ( $.trim(estado_id) != '' ) {
            $('#precios tbody tr').remove()
            $.get( 'municipios/get', { estado_id: estado_id }, function( municipios ){
            
            // Limpiamos informacion previa
            $("#municipio").empty()
            $("#municipio").append( "<option>-Selecciona un Municipio-</option>" )
            $.each( municipios, function( index, value ){
                $("#municipio").append("<option value='" + index + "'>" + value + " </option>")
            })
            })
        }
    
    });

    /*
    Cuando seleccione un municipio diferente, se lance la peticion
    que va traer la informacion combinada del api de gob.mx y de la BD
    */
    $('#municipio').on('change', function(){
        var estado_id = $('#estado').val()
        var mnpio_id = $(this).val()

        if ( $.trim(estado_id) != '' && $.trim(mnpio_id) != '' ) {
            $.get( 'precios/api', { estado: estado_id, municipio: mnpio_id }, function( datos ){   
        
            // Limpiamos informacion previa para despues recorrer la respuesta 
            // del servicio y crear uno a uno los rows de la tabla #precios
            $('#precios tbody tr').remove()
            $.each( datos, function( key, value ){ 
                var newRow = "<tr>" +
                "<td>" + value.razonsocial + "</td>" +
                "<td>" + value.rfc + "</td>" +
                "<td>" + value.numeropermiso + "</td>" +
                "<td>" + value.calle + "</td>" +
                "<td>" + value.colonia + "</td>" +
                "<td>" + value.codigopostal + "</td>" +
                "<td>" + value.regular + "</td>" +
                "<td>" + value.premium + "</td>" +
                "<td>" + value.dieasel + "</td>" +
                "</tr>"

                $('#precios tbody').append( newRow )
                
                // Consumo del api de google maps para agregar
                // marcador por gasolinera con latitude y longitude
                var latitud = value.latitude
                var longitud = value.longitude
                var GLatLng = new google.maps.LatLng( latitud, longitud )

                console.log( GLatLng )

            })


            })

        }

    });

});
