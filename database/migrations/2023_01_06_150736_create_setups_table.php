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
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('ensemble_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->boolean('piano')->default(0);
            $table->boolean('amp')->default(0);
            $table->boolean('drumset')->default(0);
            $table->enum('accompaniment',['none','cd','band']);
            $table->enum('band_award',['none','students','adults']);
            $table->enum('platform',['none','platforms','steps']);
            $table->enum('microphone',['none','area','hand']);
            $table->longText('instructions')->nullable();
            $table->longText('instrumentation')->nullable();
            $table->longText('props')->nullable();
            $table->timestamps();
            $table->unique(['event_id','ensemble_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setups');
    }
};
