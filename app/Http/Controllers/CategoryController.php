<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        Category::create([
                'name' => $request->name
            ]
        );
        return redirect(route('books.create'));

    }



    public function show(Category $category)
    {
        $books=$category->books;
        return view('category',compact('books','category'));
    }

}
