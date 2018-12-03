<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectedDeviceSwitchPort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('switch_ports', function (Blueprint $table) {
            $table->unsignedInteger('connected_device_type_id')->nullable()->after('port_number');
            $table->foreign('connected_device_type_id')->references('id')->on('connected_device_types');
            $table->integer('connected_device_id')->nullable()->after('connected_device_type_id');
            
            $table->dropForeign('switch_ports_vlan_id_foreign');
            $table->dropColumn('vlan_id');
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
