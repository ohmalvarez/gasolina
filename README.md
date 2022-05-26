
Acerca de esta prueba
==

 Es necesario crear un servicio rest en php que regrese los precios de gasolina, su ubicación geográfica y dirección. Podrá recibir los parámetros de Estado y/o Municipio y/o ordenar por precio.

Para construirlo es necesario:

- Hacer uso de sepomex (https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx)
- Construir la tabla donde se guardará la información con los códigos postales.
- Exportar el excel a la tabla del punto anterior
- Consumir el api de precios de gasolina (https://api.datos.gob.mx/v1/precio.gasolina.publico
)
- La salida de este servicio debe ser un json:

Crear una página responsiva para consumir el servicio del punto anterior. Esta página deberå tener lo siguiente:

- Formulario
- Estado
- Municipio
- Ordenamiento
- Mostrar los resultados como puntos en un mapa del lado derecho
- Mostrar una tabla con los resultados debajo del mapa
- El consumo del servicio deberá ser asíncrono
- Deberå funcionar el la mayoría de los navegadores (Chrome, Firefox, Safari, Edge)

## Tecnologias y Requisitos

- PHP version >= 7.2.10 
- Laravel ver 6.x
- Mysql ver >= 5.7.24
- Jquery v 3.5.1
- Bootstrap v 3.3.7
- Composer

## Instalación y Configuración

- Ir al folder donde se alojan los proyectos de desarrollo (usualmente htdocs o www).
- En linea de comandos, ejecutar: **git clone https://github.com/ohmalvarez/gasolina.git**
- Entra en la carpeta del proyecto recién descargado y ejecuta: **composer update**
- Crear una Base de Datos: **gasolina_dev**
- En la raiz del proyecto copiar el contenido del archivo **.env.example** con el nuevo nombre **.env**
- Editar el archivo **.env** para modificar los datos de tu host: **DB host, DB port, DB name, DB user y el DB password**.
- En este mismo archivo, agregar el parametro **API_GAS_GOB** con la url corta (https://api.datos.gob.mx)
- En linea de comandos, ejecutar **php artisan migrate**
- Llenar las tablas **c_estados, c_municipios y t_ubicaciones** con los datos del archivo 'database/xls/CPdescarga.xls' obtenido de la siguiente ruta https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx.
- En el navegador de su preferencia ir a [ruta_proyecto] y realizar las busquedas necesarias.  

<p align="center">Construido con <br><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
