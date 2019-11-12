<?php

namespace App\Http\Controllers\StarWars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function homeRoute(Request $request)
    {
        return view('home', [
            'category' => 'home'
        ]);
    }
}
