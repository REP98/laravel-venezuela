<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rep98\Venezuela\Models\Municipality;

trait HasMunicipality
{
    /**
     * Obtiene los municipios asociados al modelo.
     *
     * @return MorphToMany|null
     */
    public function municipalities(): ?MorphToMany
    {
        $table = config('VenezuelaDPT.morphRelationsTable.municipality');

        if (is_null($table)) {
            return null;
        }

        return $this->morphToMany(Municipality::class, 'municipalityable', $table);
    }
}