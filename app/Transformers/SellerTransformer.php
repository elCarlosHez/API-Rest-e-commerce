<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identificador' => (int)$seller->id,
            'nombre' => (string)$seller->name,
            'correo' => (string)$seller->email,
            'esVerificado' => (int)$seller->verified,
            'frechaCreacion' => (string)$seller->created_at,
            'frechaActualizacion' => (string)$seller->updated_at,
            'frechaEliminacion' => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,
            'link' => [
                [
                    'ref' => 'self',
                    'href' => route('sellers.show', $seller->id)
                ],
                [
                    'ref' => 'seller.buyers',
                    'href' => route('sellers.buyers.index', $seller->id)
                ],
                [
                    'ref' => 'seller.categories',
                    'href' => route('sellers.categories.index', $seller->id)
                ],
                [
                    'ref' => 'seller.products',
                    'href' => route('sellers.products.index', $seller->id)
                ],
                [
                    'ref' => 'seller.transactions',
                    'href' => route('sellers.transactions.index', $seller->id)
                ],
                [
                    'ref' => 'user',
                    'href' => route('users.show', $seller->id)
                ]
            ],
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

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
            'correo' => 'correo',
            'verified' => 'esVerificado',
            'created_at' => 'frechaCreacion',
            'updated_at' => 'frechaActualizacion',
            'deleted_at' => 'frechaEliminacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
