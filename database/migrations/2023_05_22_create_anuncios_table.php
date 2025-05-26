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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->string('url')->nullable();
            $table->string('posicion'); // banner_principal, sidebar, entre_productos, footer, etc.
            $table->string('tipo'); // interno, externo, google_adsense, etc.
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->boolean('estado')->default(true);
            $table->decimal('precio', 10, 2)->default(0);
            $table->integer('impresiones')->default(0);
            $table->integer('clics')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('universidad_id')->nullable()->constrained('universidades')->onDelete('set null');
            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');
            $table->string('codigo_adsense')->nullable(); // Para anuncios de Google AdSense
            $table->json('configuracion_adicional')->nullable(); // Para configuraciones específicas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
