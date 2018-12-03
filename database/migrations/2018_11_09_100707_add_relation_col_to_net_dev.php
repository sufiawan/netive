<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationColToNetDev extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_points', function (Blueprint $table) {
            $table->unsignedInteger('network_device_id')->nullable()->after('id');
            $table->foreign('network_device_id')->references('id')->on('network_devices');
        });
        
        Schema::table('servers', function (Blueprint $table) {
            $table->unsignedInteger('network_device_id')->nullable()->after('id');
            $table->foreign('network_device_id')->references('id')->on('network_devices');
        });
        
        Schema::table('network_switches', function (Blueprint $table) {
            $table->unsignedInteger('network_device_id')->nullable()->after('id');
            $table->foreign('network_device_id')->references('id')->on('network_devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
