<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->ipAddress('ip_address')->nullable();
            $table->smallInteger('cpu_core');
            $table->integer('ram');
            $table->char('ram_opt', 2);
            $table->integer('hdd');
            $table->char('hdd_opt', 2);
            $table->string('os');
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
        Schema::dropIfExists('virtual_servers');
    }
}
