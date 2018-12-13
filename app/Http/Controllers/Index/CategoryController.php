<?php

namespace App\Http\Controllers\Index;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category, Request $request){
        $categories = Category::all();
        $topics = $category->topics()->withOrder($request->order)->paginate(20);
        return view('index.topic.index', compact('topics', 'categories', 'category'));
    }
}
