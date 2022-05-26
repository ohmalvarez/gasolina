<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbicacionesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('d_codigo',10);
            $table->char('d_asenta',150);
//            $table->char('d_tipo_asenta',100);
            $table->char('d_mnpio',100);
            $table->char('d_estado',100);
            $table->char('d_ciudad',150);
            $table->char('d_cp',10);
            $table->integer('c_estado');
//            $table->integer('c_oficina');
//            $table->integer('c_cp')->default('0');
//            $table->integer('c_tipo_asenta');
            $table->integer('c_mnpio');
//            $table->integer('id_asenta_cpcons');
//            $table->char('d_zona',15);
//            $table->integer('c_cve_ciudad');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_ubicaciones');
    }
}
