<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function colocCategories(Colocation $colocation)
    {
        $colocation->load('categories');

        return view('colocation.coloc_categories', compact('colocation'));
    }

    public function destroy(Colocation $colocation, Category $category)
    {
        if ($category->colocation_id !== $colocation->id) {
            abort(404);
        }

        $role = $colocation->memberships()
            ->where('user_id', Auth::user()->id)
            ->whereNull('left_at')
            ->value('role');

        if ($role !== 'owner') {
            abort(403);
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
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
