<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('switch_id')->nullable();
            $table->foreign('switch_id')->references('id')->on('network_switches');
            $table->unsignedInteger('vlan_id')->nullable();
            $table->foreign('vlan_id')->references('id')->on('virtual_lans');
            $table->unsignedInteger('switch_mode_id')->nullable();
            $table->foreign('switch_mode_id')->references('id')->on('switch_modes');
            $table->tinyInteger('port_number');            
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
        Schema::dropIfExists('switch_ports');
    }
}
