<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Community extends Model
{
    protected $fillable = ['name', 'parish_id'];

    public function parish(): BelongsTo
    {
        return $this->belongsTo(Parish::class);
    }

    public function communityable(): MorphTo
    {
        return $this->morphTo();
    }
}