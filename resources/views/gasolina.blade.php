
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Gasolina</title>
        <!-- Latest compiled and minified CSS (Bootstrap) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <style type="text/css">
            #map {
                height: 300px;
                width: 100%;
                margin: 0 auto;
            }
        </style>

        <!-- Jquery Js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/buscagas.js"></script>
        <script type="text/javascript" src="js/mapa.js"></script>
    </head>
    <body>

        <div class="container">
            @inject('estados','App\Services\Estadosget' )
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>
                           Lista de Precios Gasolina
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                        <div class="form-inline pull-left">
                            <div class="form-group">
                                <select id="estado" name="estado" class="form-control">
                                    <option>-Selecciona un Estado-</option>
                                    @if( $estados->get() != null )
                                        @foreach( $estados->get() as $index => $estado )
                                        <option value="{{ $index }}"> {{ $estado }} </option>
                                        @endforeach
                                    @endif
                                </select>
                                <select id="municipio" name="municipio" class="form-control">
                                    <option>-Selecciona un Municipio-</option>
                                </select>
                            </div>

                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div id="map" name="map"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    <table id="precios" name="precios" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Razon Social</th>
                                <th>RFC</th>
                                <th>Num Permiso</th>
                                <th>Calle</th>
                                <th>Colonia</th>
                                <th>CP</th>
                                <th>Regular</th>
                                <th>Premium</th>
                                <th>Diesel</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div id="result" name="result"></div>
                </div>
            </div>

        </div>

        <!-- Google Maps apiJs -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGL_KEY') }}&callback=iniciarMapa"></script>
    </body>
</html>
