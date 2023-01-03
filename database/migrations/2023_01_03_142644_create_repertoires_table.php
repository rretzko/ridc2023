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
        Schema::create('repertoires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('ensemble_id')->index()->constrained();
            $table->string('title', 60);
            $table->string('subtitle', 60)->nullable();
            $table->string('composer', 120)->nullable();
            $table->string('arranger', 120)->nullable();
            $table->string('lyricist', 120)->nullable();
            $table->string('choreographer', 120)->nullable();
            $table->string('notes', 255)->nullable();
            $table->integer('order_by')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('repertoires');
    }
};
