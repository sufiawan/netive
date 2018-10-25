<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnmanageableSwitchPortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unmanageable_switch_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unmanageable_switch_id')->nullable();
            $table->foreign('unmanageable_switch_id')->references('id')->on('unmanageable_switches');
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
        Schema::dropIfExists('unmanageable_switch_ports');
    }
}
