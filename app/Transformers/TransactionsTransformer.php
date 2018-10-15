<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;

class TransactionsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'identificador' => (int)$transaction->id,
            'cantidad' => (int)$transaction->quantity,
            'comprador' => (int)$transaction->buyer_id,
            'producto' => (int)$transaction->product_id,
            'frechaCreacion' => (string)$transaction->created_at,
            'frechaActualizacion' => (string)$transaction->updated_at,
            'frechaEliminacion' => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null,
        ];
    }
}
