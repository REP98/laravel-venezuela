<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class City extends Model
{
    protected $fillable = ['name', 'is_capital', 'state_id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_capital' => 'boolean'
        ];
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    // Morph
    public function models(): MorphToMany
    {
        return $this->morphedByMany(
            config('VenezuelaDPT.morphToModel.city'), // Modelo relacionado (ej: User)
            'internal_model', // Nombre de la relación morfológica (internal_model)
            'modelsables', // Nombre de la tabla pivote
            'internal_model_id', // Columna en la tabla pivote que referencia al modelo interno (State)
            'modelsable_id' // Columna en la tabla pivote que referencia al modelo que usa el trait
        );
    }
}