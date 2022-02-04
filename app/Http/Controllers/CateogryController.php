<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CateogryController extends Controller
{

    public function index()
    {
        Gate::authorize('categories-read');
        $categories = Category::all();
        return view('Categories.index', compact('categories'));
    }
}
