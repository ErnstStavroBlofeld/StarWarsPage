<?php

namespace App\Http\Controllers\StarWars;

use App\Exceptions\ApiConnectionException;
use App\Exceptions\ApiResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\StarWars\Entities\SWFilms;
use App\Service\StarWars\Entities\SWPeople;
use App\Service\StarWars\Entities\SWPlanets;
use App\Service\StarWars\Entities\SWSpecies;
use App\Service\StarWars\Entities\SWStarships;
use App\Service\StarWars\Entities\SWVehicles;
use Closure;

class EntityController extends Controller
{
    private $categoryClasses;

    public function __construct()
    {
        $this->categoryClasses = [
            'people' => SWPeople::class,
            'vehicles' => SWVehicles::class,
            'planets' => SWPlanets::class,
            'starships' => SWStarships::class,
            'species' => SWSpecies::class,
            'films' => SWFilms::class,
        ];
    }

    public function entity(Request $request, string $category, int $id)
    {
        try {
            $find = Closure::fromCallable([$this->categoryClasses[$category], 'find']);
            return view('entity', [
                'category' => $category,
                'entity' => $find($id)
            ]);
        } catch (ApiConnectionException $e) {
            \abort(500);
        } catch (ApiResponseException $e) {
            \abort($e->code == 404 ? 404 : 500);
        }
    }

    public function entities(Request $request, string $category)
    {
        try {
            $all = Closure::fromCallable([$this->categoryClasses[$category], 'all']);
            return view('entities', [
                'category' => $category,
                'entities' => $all()
            ]);
        } catch (ApiConnectionException $e) {
            \abort(500);
        } catch (ApiResponseException $e) {
            \abort($e->code == 404 ? 404 : 500);
        }
    }
} 
