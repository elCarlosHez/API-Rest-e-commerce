<?php

namespace App\Http\Controllers\Product;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Transaction;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request, $rules);
        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse(
                'El comprador debe ser diferente al vendedor'
            );
        }
        if (!$buyer->isVerified()) {
            return $this->errorResponse(
                'El comprador debe ser un usuario verificado',
                409
            );
        }
        if (!$product->seller->isVerified()) {
            return $this->errorResponse(
                'El vendedor debe ser un usuario verificado',
                409
            );
        }
        if (!$product->isAvailable()) {
            return $this->errorResponse(
                'El producto para esta transacción no esta disponible',
                409
            );
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse(
                'El producto no tiene la cantidad disponible requerida para esta transacción',
                409
            );
        }

        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);

            return $this->showOne($transaction, 201);
        });
    }
}
