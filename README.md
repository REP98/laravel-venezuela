# Laravel Venezuela

Datos Geográficos de Venezuela para Laravel

![Esquema de Base de Datos](./Venezueela%20DB.jpeg)

## Instalación

```shell
$ composer require rep98/laravel-venezuela
$ php artisan venezuela:install
```

Con esto instalamos e iniciamos la carga y publicación de archivos, si debesea una instalación manual puede usar:

```shell
$ php artisan vendor:publish --tag=venezuela-config
$ php artisan vendor:publish --tag=venezuela-migrations
$ php artisan vendor:publish --tag=venezuela-seeders
```

## Información

Este paquete contiene un conjunto de semillas (`seeders`), modelos y esquemas de base de datos, que nos permiten trabajar en linea ya añadiendo todos los estados, municipio y parroquias de Venezuela.

Si deseas conocer mas detalles visita el repositorios [Venezuela](https://github.com/REP98/venezuela) donde encontraras mas información.

Si deseas ver en linea los estados y sus municipios y parroquias visita [VenezuelaDPT](https://rep98.github.io/venezuela/).

## Uso

Este paquete provee algunos elementos listos para manejar:

### Modelos

Puede usar directamente los modelos del paquete de la siguiente forma:

```php
use Rep98\Venezuela\Models\State;

var_dump(State::all());
```

Esto le imprimirá todos los estados almacenados, también puede consultar usando las relaciones

```php
use Rep98\Venezuela\Models\Parish;

$parishes = Parish::with('municipality.state')->get();

var_dump($parishes);
```

Esto imprimirá todas las parroquias con sus municipios y estados.

Ahora que pasa si queremos añadir nuestras relaciones?, Este componente ofrece un grupo de `traits` que puede usar en sus modelos.

Ejemplo: supongamos que tiene un modelo `Industry` y quieres añadir los municipios de esta industria seria asi:

```php 
// File Model/Industry.php
use Rep98\Venezuela\Traits\HasMunicipality;
use Illuminate\Database\Eloquent\Model;
class Industry extends Model {
    use HasMunicipality;
    protected $fillable = ['name', 'rif'];
}
// File Controller/IndustryController.php

$industry = Industry::find(1);
$industry->municipalities;
// Inverso
use Rep98\Venezuela\Models\Municipality;

$municipality = Municipality::find(1);

$municipality->models;
```

Solo debe asegurarse de colocar el modelo  `App\Models\Industry` en las configuración de `laravel-venezuela`

### Direcciones

Este paquete también ofrece un modelo genérico para manejar las dirección el modelos se llama `Direcction` y tiene los siguientes métodos:

+ `static function register(State|string $state = '', Municipality|string $municipality = '', Parish|string $parish = '', Community|string $community = '' ): Community|Parish|Municipality|State` `=>` Permite registrar o buscar una dirección.
    ```php
    use Rep98\Venezuela\Models\Direction;
    Direction::register('Bolivariano de Miranda', 'Charallave');
    ```
+ `static function register_city(string $city, State|string|int $state): City` `=>` Permite registrar o buscar una ciudad de un estado.
+ `static function list(Collection | array $filters = []): Collection` `=>` Lista todas las comunidades en el sistema y filtra según su parámetros.
+ `static function paginate(int $pag = 1, int $perPag = 25, Collection | array $filters = []): LengthAwarePaginator` `=>`  Permite listar todas las comunidades pero de forma Paginada.
+ `static function search(string $condition, ?string $argumentsLike = null): Collection` `=>` Permite realizar búsquedas en la DB, tenga en cuenta que `$argumentsLike` es el formato `LIKE` de búsqueda por defecto buscara en `%condition%` pero si queremos cambiar eso podemos pasarle a `$argumentsLike` algo como esto `-%` donde `-` sera reemplazado por la condición quedando asi `condition%` lo cual buscaría palabras que empiecen en.
+ `static function find(string $type, int $id): Model` `=>` Este método es igual al original de `Eloquent` solo que necesita que se le especifique si `state`, `municipality` entre otros. esto es util cuando tenemos búsquedas dinámicas en nuestro sistema.

## LICENSE

[MIT](./LICENSE)