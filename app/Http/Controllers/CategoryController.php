<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function colocCategories(Colocation $colocation)
    {
        $colocation->load('categories');

        return view('colocation.coloc_categories', compact('colocation'));
    }

    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'categoryName' => ['required', 'string', 'max:255']
        ]);

        Category::create([
            'name' => $request->categoryName,
            'colocation_id' => $request->colocation->id,
        ]);

        return redirect()->route('categories.show',$colocation)->with('success', 'Category created successfully.');;
    }

}