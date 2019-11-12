<?php

namespace App\Http\Controllers\StarWars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\StarWars\Entities\Entity;

class EntityController extends Controller
{
    public function entityRoute(Request $request, string $category, int $id = null)
    {
        return view('entity', [ 
            'category' => $category,
            'data' => ($id != null) ? Entity::find($id, $category) : Entity::all($category)
        ]);
    }
} 
