<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rep98\Venezuela\Models\Community;

trait HasCommunities {
    /**
     * Obtiene las ciudades asociadas al modelo.
     *
     * @return MorphToMany
     */
    public function communities(): MorphToMany
    {
        return $this->morphToMany(
            Community::class, // Modelo relacionado (State)
            'modelsable', // Nombre de la relación morfológica (modelsable)
            'modelsables', // Nombre de la tabla pivote
            'modelsable_id', // Columna en la tabla pivote que referencia al modelo que usa el trait
            'internal_model_id' // Columna en la tabla pivote que referencia al modelo interno (State)
        );
    }
}