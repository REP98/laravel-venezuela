<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}