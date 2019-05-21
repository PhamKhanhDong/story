<?php

namespace App\Http\Controllers\api\v1\Category;

use App\Modules\Category\Transformer\CategoryTransformer;
use Illuminate\Http\Request;
use App\Modules\Category\Models\Category;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class CategoriesApiController extends Controller
{
    public function validateCategory($request) {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => []
        ]);
    }

    public function index() {
        $categories = Category::all();
//        dd($categories);

        $categories = Fractal::create()
            ->collection($categories)
            ->transformWith(new CategoryTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($categories))
            ->toArray();

        return $categories;
    }

    public function store(Request $request) {
        return Category::create($this->validateCategory($request));
    }

    public function show(Category $category)
    {
        return $category;
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
