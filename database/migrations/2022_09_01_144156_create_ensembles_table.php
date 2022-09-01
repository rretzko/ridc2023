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
        Schema::create('ensembles', function (Blueprint $table) {
            $table->id();
            $table->string('ensemble_name');
            $table->string('abbr', 12);
            $table->foreignId('category_id')->constrained();
            $table->string('directed_by')->nullable();
            $table->longText('descr')->nullable();
            $table->string('logo_file')->nullable();
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
        Schema::dropIfExists('ensembles');
    }
};
