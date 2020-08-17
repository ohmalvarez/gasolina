<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MnpioMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_municipios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('d_mnpio',100);
            $table->char('c_mnpio',5);
            $table->integer('estados_id');
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
        Schema::dropIfExists('c_municipios');
    }
}
