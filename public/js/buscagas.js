$(document).ready( function (){

    // Queremos que  al cambiar el option del estado, muestre los municipios que le pertenecen
    $('#estado').on('change', function(){
        var estado_id = $(this).val()
        if ( $.trim(estado_id) != '' ) {
            $.get( 'municipios/get', { estado_id: estado_id }, function( municipios ){
                var estadoInfo = municipios.estado
                var LatLngEdo = { lat: Number(estadoInfo.latitud), lng: Number(estadoInfo.longitud) }

                // Traer lat, lng X estado
                map = new google.maps.Map(document.getElementById('map'), {
                  center: LatLngEdo,
                  zoom: 10
                });
            
                // Limpiamos informacion previa
                $("#municipio").empty()
                $("#municipio").append( "<option>-Selecciona un Municipio-</option>" )
                $.each( municipios.mnpios, function( index, value ){
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
                    var GLatLng = new google.maps.LatLng( value.latitude, value.longitude )

                    // Creando el marcador para la posicion inicial
                    var marker = new google.maps.Marker({
                        position: GLatLng,
                        map: map,
                        title: value.razonsocial
                    })

                    //"GASOLINERA QUINTA NORTE SA DE CV" 
                    /*
                        latitude: "16.75925"
                        longitude: "-93.1208"
                    */
                    console.log( value.latitude, value.longitude )

                })// end each

            })// end get

            /*
            Latmax: 16.76666
            Lngmax: -93.1733

            Latmin: 16.73401
            Lngmin: -93.05499

            Municipio Tuxtla Gutierrez
            */
            
            var LatLngMnpios = { lat: 16.75925, lng: -93.1208 }
            map = new google.maps.Map(document.getElementById('map'), {
                center: LatLngMnpios,
                zoom: 11
            })
        
        }// end if

    });

});