<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Community extends Model
{
    protected $fillable = ['name', 'parish_id'];

    public function parish(): BelongsTo
    {
        return $this->belongsTo(Parish::class);
    }

    // Morph
    public function models(): MorphToMany
    {
        return $this->morphedByMany(
            config('VenezuelaDPT.morphToModel.community'), // Modelo relacionado (ej: User)
            'internal_model', // Nombre de la relación morfológica (internal_model)
            'modelsables', // Nombre de la tabla pivote
            'internal_model_id', // Columna en la tabla pivote que referencia al modelo interno (State)
            'modelsable_id' // Columna en la tabla pivote que referencia al modelo que usa el trait
        );
    }
}