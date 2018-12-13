<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    public function index(){
        /*$data=['title'=> 'd22'];
        $validator = \Validator::make($data, [
            'title' => 'required|max:1',
        ]);
        dd($data, $validator, $validator->errors(), $validator->errors()->first());*/
        return view('index.index.index');
    }
}
