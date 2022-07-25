<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CredictPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Http\View\Composer\UsersComposer;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(PaymentGatewayContract::class, function ($app){
//            if (Request::has('credit')){
//                return new CredictPaymentGateway('usd');
//            }
//            return new BankPaymentGateway('usd');
//        });
    }


    public function boot()
    {
//        View::share('users',User::where('is_admin', 0)->get());

//        View::composer(['dashboard.*'],function ($views){
//            $views->with('users',User::where('is_admin', 0)->orderBy('name')->get());
//        });

//        View::composer(['dashboard.*'],UsersComposer::class);

    }
}
