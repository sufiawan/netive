<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ip_table_type_id')->nullable();
            $table->foreign('ip_table_type_id')->references('id')->on('ip_table_types');
            $table->unsignedInteger('switch_port_id')->nullable();
            $table->foreign('switch_port_id')->references('id')->on('switch_ports');
            $table->unsignedInteger('vlan_id')->nullable();
            $table->foreign('vlan_id')->references('id')->on('virtual_lans');
            $table->ipAddress('ip_address');
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
        Schema::dropIfExists('ip_tables');
    }
}
