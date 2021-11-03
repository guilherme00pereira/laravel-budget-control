<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsEventsFixedIncomeAddColumnCategoryType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table){
            $table->foreignId('category_type_id')->default(1)->constrained('category_types');
        });
        Schema::table('events', function (Blueprint $table){
            $table->dropColumn(['is_fixed', 'is_income']);
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
