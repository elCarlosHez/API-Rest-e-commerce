<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $category->products()
            // Get all transactions
            ->with('transactions')
            // Get buyers
            ->with('transactions.buyer')
            ->get()
            // Just get transactions
            ->pluck('transactions')
            // Collapse all elements
            ->collapse()
            // Getting just buyers
            ->pluck('buyer')
            ->unique()
            ->values();

        return $this->showAll($buyers);
    }
}
