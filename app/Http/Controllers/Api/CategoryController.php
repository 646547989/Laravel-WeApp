<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    public function index(){
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }
}
