<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('type');
            $table->string('bmn_number')->nullable();
            $table->year('purchase_year');
            $table->ipAddress('ip_address')->nullable();
            $table->string('device_username');
            $table->string('device_password');
            $table->string('wifi_ssid')->nullable();
            $table->string('wifi_password')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('access_points');
    }
}
