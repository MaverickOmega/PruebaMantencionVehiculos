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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('brand');                          // Marca
            $table->string('model');                          // Modelo
            $table->string('license_plate')->unique();        // Patente
            $table->unsignedSmallInteger('year');             // Año
            $table->unsignedInteger('price');                 // Precio

            // Dueño actual.

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete(); // evita borrar usuarios si tienen vehículos. Los usuarios deben tener mínimo un vehículo. 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
