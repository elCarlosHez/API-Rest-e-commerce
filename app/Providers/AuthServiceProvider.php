<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Carbon;
use App\Buyer;
use App\Seller;
use App\Policies\BuyerPolicy;
use App\Policies\SellerPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Buyer::class => BuyerPolicy::class,
        Seller::class => SellerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerPolicies();
        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addMinutes(5));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();

        Passport::tokensCan([
            'purchase-product' => 'Crear transacciones para comprar productos determinados.',
            'manage-products' => 'Crear, ver, actualizar y eliminar productos',
            'manage-account' => 'Obtener la información de la cuenta, nombre, email, estado ( sin contraseña), modificar datos como email, nombre, y contraseña. No puede liminar la cuenta',
            'read-general' => 'Obtener información general, categorias donse se compra y se vende, productos vendidos o comprados, transacciones, compras y ventas',

        ]);
    }
}
