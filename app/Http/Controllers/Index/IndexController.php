<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function index(){

        dd(Route::currentRouteName());
    }
}