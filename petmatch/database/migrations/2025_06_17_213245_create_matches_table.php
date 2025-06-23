<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void {
         Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet1_id')->constrained('pets')->onDelete('cascade');
            $table->foreignId('pet2_id')->constrained('pets')->onDelete('cascade');
            $table->enum('status', ['pendente', 'aceito', 'rejeitado']);
            $table->unique(['pet1_id', 'pet2_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
