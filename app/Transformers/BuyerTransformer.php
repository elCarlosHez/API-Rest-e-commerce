<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identificador' => (int)$buyer->id,
            'nombre' => (string)$buyer->name,
            'correo' => (string)$buyer->email,
            'esVerificado' => (int)$buyer->verified,
            'frechaCreacion' => (string)$buyer->created_at,
            'frechaActualizacion' => (string)$buyer->updated_at,
            'frechaEliminacion' => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'correo',
            'esVerificado' => 'verified',
            'frechaCreacion' => 'created_at',
            'frechaActualizacion' => 'updated_at',
            'frechaEliminacion' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
