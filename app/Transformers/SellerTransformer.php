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
            'nombre' => (string)$seller->nombre,
            'correo' => (string)$seller->email,
            'esVerificado' => (int)$seller->verified,
            'frechaCreacion' => (string)$seller->created_at,
            'frechaActualizacion' => (string)$seller->updated_at,
            'frechaEliminacion' => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,
        ];
    }
}
