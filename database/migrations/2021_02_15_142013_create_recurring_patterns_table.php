<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringPatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_patterns', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('day_of_week')->nullable();
            $table->tinyInteger('week_of_month')->nullable();
            $table->tinyInteger('day_of_month')->nullable();
            $table->tinyInteger('month_of_year')->nullable();
            $table->tinyInteger('num_of_occurrences');
            $table->foreignId('event_id')->constrained('events');
            $table->foreignId('recurring_type_id')->constrained('recurring_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurring_patterns');
    }
}
