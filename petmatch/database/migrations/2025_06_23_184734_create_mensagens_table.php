<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remetente_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('destinatario_id')->constrained('usuarios')->onDelete('cascade');
            $table->text('conteudo');
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->timestamp('lida_em')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagens');
    }
};
