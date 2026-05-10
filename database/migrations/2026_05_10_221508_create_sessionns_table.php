<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessionns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->foreignId('game_id')->constrained();

            $table->string('transport_type');

            $table->integer('difficulty');

            $table->integer('team_size');

            $table->integer('children_under_10')->default(0);

            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessionns');
    }
};
