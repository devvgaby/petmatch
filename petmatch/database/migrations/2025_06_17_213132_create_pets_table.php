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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('especie', 50);
            $table->string('raca', 100)->nullable();
            $table->unsignedInteger('idade');
            $table->enum('sexo', ['macho', 'femea']);
            $table->text('descricao')->nullable();
            $table->text('preferencias')->nullable();
            $table->string('foto_perfil_url', 255)->nullable();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
