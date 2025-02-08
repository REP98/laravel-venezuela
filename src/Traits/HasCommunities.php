<?php

namespace Rep98\Venezuela\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rep98\Venezuela\Models\Community;

trait HasCommunities {
    public function communities(): MorphMany
    {   
        $table = config('VenezuelaDPT.morphRelationsTable.community', "communityable");
        return $this->morphMany(Community::class, "communityable", $table);
    }
}