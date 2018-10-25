<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageableSwitchPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manageable_switch_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manageable_switch_id')->nullable();
            $table->foreign('manageable_switch_id')->references('id')->on('manageable_switches');
            $table->unsignedInteger('vlan_id')->nullable();
            $table->foreign('vlan_id')->references('id')->on('virtual_l_a_ns');
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
        Schema::dropIfExists('manageable_switch_ports');
    }
}
