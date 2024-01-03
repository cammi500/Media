<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get all categories
    public function allCategoryList(){
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }
}
