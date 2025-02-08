<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rep98\Venezuela\Models\Parish;

trait HasParish
{
    /**
     * Obtiene las parroquias asociadas al modelo.
     *
     * @return MorphToMany|null
     */
    public function parishes(): ?MorphToMany
    {
        $table = config('VenezuelaDPT.morphRelationsTable.parish');

        if (is_null($table)) {
            return null;
        }

        return $this->morphToMany(Parish::class, 'parishable', $table);
    }
}