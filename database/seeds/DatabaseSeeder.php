<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $cantidadUsuarios = 500;
        $cantidadCategorias = 50;
        $cantidadProductos = 200;
        $cantidadTransacciones = 100;

        factory(User::class, $cantidadUsuarios)->create();
        factory(Category::class, $cantidadCategorias)->create();

        factory(Product::class, $cantidadTransacciones)->create()->each(
            function ($producto) {
                $categorias = Category::all()->random(mt_rand(1, 5))->pluck('id');

                $producto->categories()->attach($categorias);
            }
        );

        factory(Transaction::class, $cantidadTransacciones)->create();
    }
}
