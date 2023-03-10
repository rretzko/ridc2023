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
        Schema::create('adjudicator_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adjudicator_id')->constrained();
            $table->foreignId('event_id')->index()->constrained();
            $table->boolean('concert')->default(1);
            $table->unique(['adjudicator_id','event_id','concert'], 'all');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjudicator_events');
    }
};
