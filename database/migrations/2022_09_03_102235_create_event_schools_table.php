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
        Schema::create('event_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->index()->constrained();
            $table->foreignId('school_id')->constrained();
            $table->integer('attending_students')->default(1);
            $table->integer('attending_adults')->default(1);
            $table->string('eta')->default('09:00:00');
            $table->string('hotel')->default('none');
            $table->timestamps();
            $table->unique(['event_id','school_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_schools');
    }
};
