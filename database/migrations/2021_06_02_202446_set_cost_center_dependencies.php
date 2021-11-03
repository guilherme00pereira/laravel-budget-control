<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetCostCenterDependencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table){
           $table->foreignId('cost_center_id')->default(1)->constrained('cost_centers');
        });
        Schema::table('events', function (Blueprint $table){
            $table->foreignId('cost_center_id')->default(1)->constrained('cost_centers');
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
