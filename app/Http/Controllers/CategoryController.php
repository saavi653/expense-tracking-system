<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([

            'name' => 'required|min:3|max:255|unique:categories|string'
        ]);
        
        Category::create($attributes);

        return redirect()->route('user.dashboard')
            ->with('success', 'Category Added Successfully');
    }
}
