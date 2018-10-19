<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreSwitchPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_switch_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('core_switch_id')->nullable();
            $table->foreign('core_switch_id')->references('id')->on('core_switches');
            $table->string('port_number');
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_switch_ports');
    }
}
