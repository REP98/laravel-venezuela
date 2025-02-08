<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Rep98\Venezuela\Models\State;

trait HasState
{
    /**
     * Obtiene los estados asociados al modelo.
     *
     * @return MorphToMany|null
     */
    public function states(): ?MorphToMany
    {
        $table = config('VenezuelaDPT.morphRelationsTable.state');

        if (is_null($table)) {
            return null;
        }

        return $this->morphToMany(State::class, 'stateable', $table);
    }
}