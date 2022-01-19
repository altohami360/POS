<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CateogryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return view('Categories.index', compact('categories'));
    }
}
