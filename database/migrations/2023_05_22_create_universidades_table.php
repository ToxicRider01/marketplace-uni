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
        Schema::create('universidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('siglas');
            $table->string('logo')->nullable();
            $table->string('ciudad');
            $table->string('direccion')->nullable();
            $table->string('sitio_web')->nullable();
            $table->timestamps();
        });

        // Insertar universidades de Nuevo Chimbote
        DB::table('universidades')->insert([
            [
                'nombre' => 'Universidad Nacional del Santa',
                'siglas' => 'UNS',
                'ciudad' => 'Nuevo Chimbote',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Universidad San Pedro',
                'siglas' => 'USP',
                'ciudad' => 'Nuevo Chimbote',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Universidad César Vallejo',
                'siglas' => 'UCV',
                'ciudad' => 'Nuevo Chimbote',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Universidad Católica Los Ángeles de Chimbote',
                'siglas' => 'ULADECH',
                'ciudad' => 'Nuevo Chimbote',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Universidad Alas Peruanas',
                'siglas' => 'UAP',
                'ciudad' => 'Nuevo Chimbote',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universidades');
    }
};
