<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();

        return response([
            'data' => $data,
            'message' => 'Category Index'
        ], 200);
    }
}
