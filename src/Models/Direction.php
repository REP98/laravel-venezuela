<?php

namespace Rep98\Venezuela\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Direction
{
    /**
     * Search for an address, creating records if they do not exist.
     *
     * @param State|string $state
     * @param Municipality|string $municipality
     * @param Parish|string $parish
     * @param Community|string $community
     * @return \Rep98\Venezuela\Models\Community|\Rep98\Venezuela\Models\Parish|\Rep98\Venezuela\Models\Municipality|\Rep98\Venezuela\Models\State
     */
    public static function register(
        State|string $state = '',
        Municipality|string $municipality = '',
        Parish|string $parish = '',
        Community|string $community = ''
    ): Community|Parish|Municipality|State
    {
        // Maneja el registro del estado
        if (is_string($state) && !empty($state)) {
            $state = State::firstOrCreate(['name' => $state]);
        }

        if (!($state instanceof State)) {
            throw new InvalidArgumentException("The State is required as the first argument");
        }

        // Maneja el registro del municipio
        if (is_string($municipality) && !empty($municipality)) {
            $municipality = Municipality::firstOrCreate([
                'name' => $municipality,
                'state_id' => $state->id
            ]);
        }

        // Maneja el registro de la parroquia
        if (is_string($parish) && !empty($parish)) {
            $parish = Parish::firstOrCreate([
                'name' => $parish,
                'municipality_id' => $municipality->id
            ]);
        }

        // Maneja el registro de la comunidad
        if (is_string($community) && !empty($community)) {
            $community = Community::firstOrCreate([
                'name' => $community,
                'parish_id' => $parish->id 
            ]);
        }

        if (!empty($community) && $community instanceof Community) {
            $community->load("parish.municipality.state");
            return $community;
        }

        if (!empty($parish) && $parish instanceof Parish) {
            $parish->load('municipality.state');
            return $parish;
        }

        if(!empty($municipality) && $municipality instanceof Municipality) {
            $municipality->load('state');
            return $municipality;
        }

        return $state;
    }
    /**
     * Search for a City, creating it if it doesn't exist.
     *
     * @param   string  $city
     * @param   State|string|int $state
     *
     * @return  \Rep98\Venezuela\Models\City
     */
    public static function register_city(string $city, State|string|int $state): City {
        if (is_numeric($state)) {
            $state = State::find($state);
        } else if (is_string($state)) {
            $state = State::where('name', $state)->first();
        } else if (!($state instanceof State)) {
            throw new InvalidArgumentException("The State is required");
        }

        $ct = City::firstOrCreate(['city' => $city, 'state_id' => $state->id]);
        $ct->load("state");
        return $ct;
    }
    /**
     * Returns a list of addresses
     *
     * @param   Collection|Array       $filters
     *
     * @return  \Illuminate\Database\Eloquent\Collection
     */
    public static function list(Collection | array $filters = []): Collection
    {
        $query = Community::query();

        if (isset($filters['state'])) {
            $query->whereHas('parish.municipality.state', function ($q) use ($filters) {
                $q->where('name', $filters['state']);
            });
        }

        if (isset($filters['municipality'])) {
            $query->whereHas('parish.municipality', function ($q) use ($filters) {
                $q->where('name', $filters['municipality']);
            });
        }

        if (isset($filters['parish'])) {
            $query->whereHas('parish', function ($q) use ($filters) {
                $q->where('name', $filters['parish']);
            });
        }

        if (isset($filters['community'])) {
            $query->where('name', $filters['community']);
        }

        return $query->with(['parish.municipality.state'])->get();
    }
    /**
     * Performs pagination on a list.
     *
     * @param   int                   $pag 
     * @param   int                   $perPag 
     * @param   Collection|array      $filters
     *
     * @return  \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function paginate(int $pag = 1, int $perPag = 25, Collection | array $filters = []): LengthAwarePaginator
    {
        $query = Community::query(); 

        if (isset($filters['state'])) {
            $query->whereHas('parish.municipality.state', function ($q) use ($filters) {
                $q->where('name', $filters['state']);
            });
        }

        if (isset($filters['municipality'])) {
            $query->whereHas('parish.municipality', function ($q) use ($filters) {
                $q->where('name', $filters['municipality']);
            });
        }

        if (isset($filters['parish'])) {
            $query->whereHas('parish', function ($q) use ($filters) {
                $q->where('name', $filters['parish']);
            });
        }

        if (isset($filters['community'])) {
            $query->where('name', $filters['community']);
        }

        return $query->with(['parish.municipality.state'])->paginate($perPag, ['*'], 'page', $pag);
    }

    /**
     * Performs a lookup of all address tables.
     *
     * @param string $condition
     * @param ?string $argumentsLike Depending on the type of search, if it is null it would be `%condition%, you can use `-%` or `%-` where `-` is replaced by condition
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function search(string $condition, ?string $argumentsLike = null): Collection
    {
        $condition = self::formatCondition($condition, $argumentsLike);

        // Buscar en Estados
        $states = State::where('name', 'LIKE', $condition)->with('municipalities.parishes.communities')->get();

        // Buscar en Municipios
        $municipalities = Municipality::where('name', 'LIKE', $condition)->with('state', 'parishes.communities')->get();

        // Buscar en Parroquias
        $parishes = Parish::where('name', 'LIKE', $condition)->with('municipality.state', 'communities')->get();

        // Buscar en Comunidades
        $communities = Community::where('name', 'LIKE', $condition)->with('parish.municipality.state')->get();

        // Buscar en Ciudades
        $cities = City::where('name', 'LIKE', $condition)->with('state')->get();

        // Combinar todos los resultados en una sola colección
        return $states->merge($municipalities)->merge($parishes)->merge($communities)->merge($cities);
    }


    /**
     * Search for an item by its ID
     *
     * @param   string  $type
     * @param   int     $id
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    protected static function find(string $type, int $id): Model
    {
        $model = self::getModelInstance($type);
        $relationship = null;
        if ($type == 'Municipality') { $relationship = "state"; }
        else if($type == 'Parish') { $relationship = 'municipality.state'; }
        else if($type == 'Community') { $relationship = 'parish.municipality.state'; }
        $entry = $model->find($id);
        if (!empty($relationship)) {
            $entry->load($relationship);
        }
        return $entry;
    }
    /**
     * Gets an instance of the corresponding model.
     *
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected static function getModelInstance(string $type): Model {
        $models = [
            'state' => State::class,
            'municipality' => Municipality::class,
            'parish' => Parish::class,
            'community' => Community::class,
            'city' => City::class,
        ];

        if (!isset($models[$type])) {
            throw new \InvalidArgumentException("Invalid model: $type");
        }

        return new $models[$type]; 
    }

    /**
     * Formats the search condition based on the $argumentsLike parameter.
     *
     * @param string $condition
     * @param ?string|array $argumentsLike
     * @return string
     */
    protected static function formatCondition(string $condition, ?string $argumentsLike = null): string
    {
        if (is_null($argumentsLike)) {
            return '%' . $condition . '%';
        }

        if (is_string($argumentsLike)) {
            return str_replace('-', $condition, $argumentsLike);
        }

        return '%' . $condition . '%';
    }
}