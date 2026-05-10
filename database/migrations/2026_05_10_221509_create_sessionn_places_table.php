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
        Schema::create('sessionn_places', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sessionn_id')->constrained()->cascadeOnDelete();

            $table->foreignId('place_id')->constrained()->cascadeOnDelete();

            $table->boolean('validated')->default(false);

            $table->timestamp('validated_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessionn_places');
    }
};
