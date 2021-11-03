<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableEventsAndTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table){
            $table->foreignId('tag_id')->nullable();
        });
        Schema::table('tags', function (Blueprint $table){
            $table->date('initial_day')->default('2001-01-01');
            $table->date('end_day')->default('2001-01-01');;
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
