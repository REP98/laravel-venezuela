<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class State extends Model
{
    protected $fillable = ['name', 'iso'];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    // Morph
    public function models(): MorphToMany
    {
        return $this->morphedByMany(
            config('VenezuelaDPT.morphToModel.state'), // Modelo relacionado (ej: User)
            'internal_model', // Nombre de la relación morfológica (internal_model)
            'modelsables', // Nombre de la tabla pivote
            'internal_model_id', // Columna en la tabla pivote que referencia al modelo interno (State)
            'modelsable_id' // Columna en la tabla pivote que referencia al modelo que usa el trait
        );
    }
}