<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageableSwitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manageable_switches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_type', 150);
            $table->string('bmn_number')->nullable();
            $table->year('purchase_year');
            $table->ipAddress('ip_address')->nullable();
            $table->string('device_username');
            $table->string('device_password');
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
        Schema::dropIfExists('manageable_switches');
    }
}
