# StarWars Page v2

Generalnie to głównym failem była samoobsługa modelu - sam pobierał sobie wszystkie potrzebne dane; W następnej wersji raczej rozdzielę to do na obiekt z danymi i obiekt od pobierania danych.

## Skrypty do testu w konsoli

Pobieranie obiektów:
```php
use App\Service\StarWars\Entities\People; // albo Films, Planets, Species, Starships, Vehicles
$res = People::find(1);
$res = People::all();
```

Wyświetlanie właściwości:
```php
$name = $res->name;        //dla pojedyńczego obiektu
$names = $res->map->names; //dla wielu obiektów

$starshipNames = $res->starships->map->name;  //Nazwy statków które dana osoba może plilotować (pojedyńczy obiekt)
```

## Problem renderowania

Brak rekursywności w renderowaniu obiektów;
Z powodu implementacji ciągłe pobieranie danych przy próbie odczytania listy
`StarWars/resources/views/templates/sw-entity.blade.php`

