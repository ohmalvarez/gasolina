$(document).ready( function (){
    let LatLngEdo = {};

    // Queremos que  al cambiar el option del estado, muestre los municipios que le pertenecen
    $('#estado').on('change', function(){
        let estado_id = $(this).val();
        if ( $.trim(estado_id) != '' ) {
            $('#precios tbody tr').remove();
            $('#result h4').remove();

            $.get( 'municipios/get', { estado_id: estado_id }, function( municipios ){
                let estadoInfo = municipios.estado,
                    LatLngEdo = { lat: Number(estadoInfo.latitud), lng: Number(estadoInfo.longitud) },
                    map = new google.maps.Map(document.getElementById('map'), { // Traer lat, lng X estado
                        center: LatLngEdo,
                        zoom: 10
                    });

                // Limpiamos informacion previa
                $("#municipio").empty();
                $("#municipio").append( "<option>-Selecciona un Municipio-</option>" );
                $.each( municipios.mnpios, function( index, value ){
                    $("#municipio").append("<option value='" + index + "'>" + value + " </option>");
                })
                })

        }

    });

    /*
    Cuando seleccione un municipio diferente, se lance la peticion
    que va traer la informacion combinada del api de gob.mx y de la BD
    */
    $('#municipio').on('change', function(){
        let estado_id = $('#estado').val(),
            mnpio_id = $(this).val(),
            mnpio_name = this.options[this.selectedIndex].text;

        if ( $.trim(estado_id) != '' && $.trim(mnpio_id) != '' ) {
            $.get( 'precios/api', { estado: estado_id, municipio: mnpio_id }, function( datos ){

                // Limpiamos informacion previa para despues recorrer la respuesta
                // del servicio y crear uno a uno los rows de la tabla #precios
                $('#precios tbody tr').remove();
                $('#result h4').remove();

                if ( datos.length>0 ) {
                    $.each(datos, function (key, value) {
                        let newRow = "<tr>" +
                            "<td>" + value.razonsocial + "</td>" +
                            "<td>" + value.rfc + "</td>" +
                            "<td>" + value.numeropermiso + "</td>" +
                            "<td>" + value.calle + "</td>" +
                            "<td>" + value.colonia + "</td>" +
                            "<td>" + value.codigopostal + "</td>" +
                            "<td bgcolor='green'>" + value.regular + "</td>" +
                            "<td bgcolor='red'>" + value.premium + "</td>" +
                            "<td>" + value.diesel + "</td>" +
                            "</tr>",
                            GLatLng = new google.maps.LatLng(value.latitude, value.longitude),      // Api google consumption
                            marker = new google.maps.Marker({           //Create market for initial position
                                position: GLatLng,
                                map: map,
                                title: value.razonsocial
                            });

                        $('#precios tbody').append(newRow);

                    })// end each
                } else
                    $('#precios tbody').append("<tr><td colspan='9' style='text-align: center;'>No fue posible encontrar una coincidencia.</td></tr>");

                $('#result').append("<h4><b>" + datos.length + " resultado(s)</b> para el municipio <b>" + mnpio_name + "</b></h4>");
            })// end get

            let map = new google.maps.Map(document.getElementById('map'), {
                center: LatLngEdo,
                zoom: 9
            })

        }// end if

    });

});
