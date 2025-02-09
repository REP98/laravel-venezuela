<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modelsables', function (Blueprint $table) {
            $table->id();

            // Columnas para el modelo que usa el trait (por ejemplo, User)
            $table->unsignedBigInteger('modelsable_id'); // ID del modelo relacionado (ej: User)
            $table->string('modelsable_type'); // Tipo del modelo relacionado (ej: App\Models\User)

            // Columnas para el modelo de tu paquete (por ejemplo, State)
            $table->unsignedBigInteger('internal_model_id'); // ID del modelo interno (ej: State)
            $table->string('internal_model_type'); // Tipo del modelo interno (ej: Rep98\Venezuela\Models\State)

            $table->timestamps();

            // Índices para mejorar el rendimiento
            $table->index(['modelsable_id', 'modelsable_type']);
            $table->index(['internal_model_id', 'internal_model_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('modelsables');
    }
};
