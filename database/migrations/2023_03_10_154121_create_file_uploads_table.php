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
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId( 'school_id')->constrained();
            $table->foreignId('ensemble_id')->constrained();
            $table->foreignId('adjudicator_id')->constrained();
            $table->tinyInteger('partial')->default(1);
            $table->string('url');
            $table->foreignId('uploaded_by')->comment('user_id')->constrained('users');
            $table->timestamps();
            $table->unique(['event_id','school_id','ensemble_id','adjudicator_id','partial'],'all');
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
        Schema::dropIfExists('file_uploads');
    }
};
