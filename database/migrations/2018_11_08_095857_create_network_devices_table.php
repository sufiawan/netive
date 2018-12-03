<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_devices', function (Blueprint $table) {
            $table->increments('id');           
            $table->unsignedInteger('network_device_type_id')->nullable();
            $table->foreign('network_device_type_id')->references('id')->on('network_device_types');
            $table->string('brand_type', 150);
            $table->string('bmn_number')->nullable();
            $table->year('purchase_year');            
            $table->string('device_username')->nullable();
            $table->string('device_password')->nullable();
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
        Schema::dropIfExists('network_devices');
    }
}
