<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identificador' => (int)$category->id,
            'Titulo' => (string)$category->nombre,
            'Detalles' => (string)$category->description,
            'frechaCreacion' => (string)$category->created_at,
            'frechaActualizacion' => (string)$category->updated_at,
            'frechaEliminacion' => isset($category->deleted_at) ? (string)$category->deleted_at : null,
        ];
    }
}
