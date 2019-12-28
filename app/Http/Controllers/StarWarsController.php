<?php

namespace App\Http\Controllers;

use App\Exceptions\ParseException;
use App\Exceptions\ValidateException;
use Closure;
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

    private function requestDataLoad(string $category, int $id = null)
    {
        $loader = Closure::fromCallable([$this->dataCategories[$category], $id == null ? 'all' : 'find']);

        try {
            return $loader($id);
        } catch (ApiConnectionException $exception) {
            abort(500, [
                'details' => 'External api is not responding'
            ]);
        } catch (ApiResponseException $exception) {
            if ($exception->code == 404) {
                abort(404, [
                    'details' => 'Entity not found'
                ]);
            } else {
                abort(500, [
                    'details' => 'External api returned invalid response'
                ]);
            }
        } catch (MissingFieldException | ParseException | ValidateException $exception) {
            abort(500, [
                'details' => 'Data returned is corrupted'
            ]);
        }

        return null;
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
        return view('pages.entity', [
            'navigation' => $this->getNavigationButtons(),
            'location' => $category,
            'category' => $category,
            'entity' => $this->requestDataLoad($category, $id)
        ]);
    }

    public function entitiesRequest(Request $request, string $category)
    {
        return view('pages.entities', [
            'navigation' => $this->getNavigationButtons(),
            'location' => $category,
            'category' => $category,
            'entities' => $this->requestDataLoad($category)
        ]);
    }

    public function queryDataRequest(Request $request)
    {
        $categoriesCopy = $this->dataCategories;

        array_walk($categoriesCopy, function (&$value, $category) {
            $value = $this->requestDataLoad($category);
        });

        return $categoriesCopy;
    }
}
