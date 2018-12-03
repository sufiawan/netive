<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRelationSwitchPortDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('switch_ports', function (Blueprint $table) {            
            $table->dropForeign('switch_ports_connected_device_type_id_foreign');            
            $table->foreign('connected_device_type_id')->references('id')->on('network_device_types');                        
        });
        
        Schema::dropIfExists('connected_device_types');
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
