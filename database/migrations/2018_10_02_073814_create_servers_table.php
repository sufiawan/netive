<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand_type', 150);
            $table->string('bmn_number')->nullable();
            $table->year('purchase_year');
            $table->ipAddress('ip_address')->nullable();
            $table->string('device_username');
            $table->string('device_password');
            $table->string('cpu');
            $table->smallInteger('cpu_core');
            $table->string('hdd');
            $table->integer('hdd_capacity');
            $table->char('hdd_capacity_opt', 2);
            $table->string('ram');
            $table->integer('ram_capacity');
            $table->char('ram_capacity_opt', 2);
            $table->string('os')->nullable();
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
        Schema::dropIfExists('servers');
    }
}
