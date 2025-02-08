<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rep98\Venezuela\Models\City;

trait HasCity
{
    /**
     * Obtiene las ciudades asociadas al modelo.
     *
     * @return MorphToMany|null
     */
    public function cities(): ?MorphToMany
    {
        $table = config('VenezuelaDPT.morphRelationsTable.city');

        if (is_null($table)) {
            return null;
        }

        return $this->morphToMany(City::class, 'cityable', $table);
    }
}