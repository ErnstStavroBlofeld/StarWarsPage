<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ApiConnectionException;
use App\Exceptions\MissingFieldException;
use App\Service\StarWars\Entities\SWFilms;
use App\Service\StarWars\Entities\SWPeople;
use App\Service\StarWars\Entities\SWPlanets;
use App\Service\StarWars\Entities\SWSpecies;
use App\Service\StarWars\Entities\SWStarships;
use App\Service\StarWars\Entities\SWVehicles;

class StarWarsController extends Controller
{
    public $dataCategories = [
        'people' => SWPeople::class, 
        'vehicles' => SWVehicles::class, 
        'planets' => SWPlanets::class, 
        'starships' => SWStarships::class, 
        'species' => SWSpecies::class, 
        'films' => SWFilms::class
    ];

    private function getNavigationButtons()
    {
        return \array_merge(['home', 'query'], \array_keys($this->dataCategories));
    }

    public function homeRequest(Request $request)
    {
        return view('pages.home', [
            'navigation' => $this->getNavigationButtons(),
            'location' => 'home'
        ]);
    }

    public function queryRequest(Request $request)
    {
        return view('pages.query', [
            'navigation' => $this->getNavigationButtons(),
            'location' => 'query'
        ]);
    }

    public function entityRequest(Request $request, string $category, int $id)
    {
        try {
            $find = Closure::fromCallable([$this->dataCategories[$category], 'find']);
            $entity = $find($id);
        } catch (MissingFieldException | ApiConnectionException $e) {
            \abort(500);
        } catch (ApiResponseException $e) {
            \abort($e->code == 404 ? 404 : 500);
        }

        return view('pages.entity', [
            'navigation' => $this->getNavigationButtons(),
            'location' => $category,
            'category' => $category,
            'categoryDisplayName' => Str::ucfirst($category),
            'entity' => $entity
        ]);
    }

    public function entitiesRequest(Request $request, string $category)
    {
        try {
            $all = Closure::fromCallable([ $this->dataCategories[$category], 'all' ]);
            $entities = $all();
        } catch (MissingFieldException | ApiConnectionException $e) {
            \abort(500);
        } catch (ApiResponseException $e) {
            \abort($e->code == 404 ? 404 : 500);
        }

        return view('pages.entities', [
            'navigation' => $this->getNavigationButtons(),
            'location' => $category,
            'category' => $category,
            'categoryDisplayName' => Str::ucfirst($category),
            'entities' => $entities
        ]);
    }

    public function queryDataRequest(Request $request)
    {
        try {
            $allCategories = [];

            foreach ($this->dataCategories as $category => $class) {
                $all = Closure::fromCallable([ $class, 'all' ]);
                $allCategories[$category] = \array_map(function ($entity) {
                    return $entity->getArrayProperties();
                }, $all());
            }
        } catch (\Exception $e) {
            \abort(500, [ 'error' => 'Internal error', 'code' => 500 ]);
        }

        return $allCategories;
    }
}
