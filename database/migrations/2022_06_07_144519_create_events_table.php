<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('descr');
            $table->date('open_date');
            $table->date('close_date');
            $table->date('event_date');
            $table->time('start_time')->default('09:00:00');
            $table->time('end_time')->default('23:00:00');
            $table->double('ensemble_fee', 6,2)->default('400.00');
            $table->integer('max_soloists')->default(4);
            $table->integer('max_concert')->default(2);
            $table->integer('max_show')->default(2);
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
        Schema::dropIfExists('events');
    }
};
