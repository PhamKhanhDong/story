<?php

namespace App\Modules\Category\Transformers;

use App\Modules\Category\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'name' => $category->name,
            'email' => $category->description,
        ];
    }
}