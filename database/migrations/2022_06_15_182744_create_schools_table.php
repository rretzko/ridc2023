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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address_1')->default('Address 1');
            $table->string('address_2')->nullable();
            $table->string('city')->default('City');
            $table->foreignId('geostate_id')->default(37)->constrained();
            $table->string('postal_code')->default('12345-6789');
            $table->string('colors')->default('none,none,none');
            $table->integer('student_body')->default(0);
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
        Schema::dropIfExists('schools');
    }
};
