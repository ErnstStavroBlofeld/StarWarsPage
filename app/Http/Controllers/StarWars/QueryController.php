<?php

namespace App\Http\Controllers\StarWars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueryController extends Controller
{
    public function query(Request $request)
    {
        return view('query', [
            'category' => 'query'
        ]);
    }
}
