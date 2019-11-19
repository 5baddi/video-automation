<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class RootController extends Controller
{
    public function index()
    {
        $routesUris = Route::getRoutes();
        $uris = [];
        foreach($routesUris as $uri)
            $uris[] = $uri->uri();

        return response()->json(['Links' => $uris]);
    }
}
