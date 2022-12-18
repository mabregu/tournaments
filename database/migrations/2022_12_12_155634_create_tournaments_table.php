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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['female', 'male']);
            $table->enum('type', ['single', 'double'])->default('single');
            $table->enum('status', ['pending', 'ongoing', 'finished']);
            $table->foreignId('winner_id')->nullable()->constrained('players');
            $table->foreignId('second_place_id')->nullable()->constrained('players');
            $table->foreignId('third_place_id')->nullable()->constrained('players');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('tournaments');
    }
};
