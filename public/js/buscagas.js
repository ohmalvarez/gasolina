$(document).ready( function (){
    let LatLngEdo = {}

    // Queremos que  al cambiar el option del estado, muestre los municipios que le pertenecen
    $('#estado').on('change', function(){
        var estado_id = $(this).val()
        if ( $.trim(estado_id) != '' ) {
            $('#precios tbody tr').remove()
            $('#result h4').remove()

            $.get( 'municipios/get', { estado_id: estado_id }, function( municipios ){
                var estadoInfo = municipios.estado
                LatLngEdo = { lat: Number(estadoInfo.latitud), lng: Number(estadoInfo.longitud) }

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
        var mnpio_name = this.options[this.selectedIndex].text

        if ( $.trim(estado_id) != '' && $.trim(mnpio_id) != '' ) {
            $.get( 'precios/api', { estado: estado_id, municipio: mnpio_id }, function( datos ){

                // Limpiamos informacion previa para despues recorrer la respuesta
                // del servicio y crear uno a uno los rows de la tabla #precios
                $('#precios tbody tr').remove()
                $('#result h4').remove()

                if ( datos.length>0 ) {
                    $.each(datos, function (key, value) {
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

                        $('#precios tbody').append(newRow)

                        // Consumo del api de google maps para agregar
                        // marcador por gasolinera con latitude y longitude
                        var GLatLng = new google.maps.LatLng(value.latitude, value.longitude)

                        // Creando el marcador para la posicion inicial
                        var marker = new google.maps.Marker({
                            position: GLatLng,
                            map: map,
                            title: value.razonsocial
                        })


                    })// end each
                } else
                    $('#precios tbody').append("<tr><td colspan='9' style='text-align: center;'>No fue posible encontrar una coincidencia.</td></tr>")

                $('#result').append("<h4><b>" + datos.length + " resultado(s)</b> para el municipio <b>" + mnpio_name + "</b></h4>")
            })// end get

            map = new google.maps.Map(document.getElementById('map'), {
                center: LatLngEdo,
                zoom: 9
            })

        }// end if

    });

});
