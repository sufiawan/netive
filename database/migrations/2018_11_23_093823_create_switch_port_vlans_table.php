<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchPortVlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_port_vlans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('switch_port_id');
            $table->foreign('switch_port_id')->references('id')->on('switch_ports');
            $table->unsignedInteger('vlan_id');
            $table->foreign('vlan_id')->references('id')->on('virtual_lans');
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
        Schema::dropIfExists('switch_port_vlans');
    }
}
