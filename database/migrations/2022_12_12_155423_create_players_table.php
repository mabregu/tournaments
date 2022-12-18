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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('height')->default(0);
            $table->integer('weight')->default(0);
            $table->integer('speed')->default(0); // Only for male players
            $table->integer('strength')->default(0); // Only for male players
            $table->integer('reaction_time')->default(0);// Only for female players
            $table->integer('ability')->default(0);
            $table->boolean('lucky')->default(false);
            $table->enum('gender', ['female', 'male']);
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
        Schema::dropIfExists('players');
    }
};
