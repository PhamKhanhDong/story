<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function validateCategory($request) {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => []
        ]);
    }

    public function index() {
        return Category::all();
    }

    public function store(Request $request) {
        return Category::create($this->validateCategory($request));
    }

    public function update(Request $request, Category $category) {
        $category->update($this->validateCategory($request));
        return $category;
    }

    public function destroy(Category $category) {
        $category->delete();
        return;
    }
}
