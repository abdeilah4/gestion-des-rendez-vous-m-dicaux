<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Milon\Barcode\BarcodeServiceProvider as MilonBarcodeServiceProvider;

class BarcodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(MilonBarcodeServiceProvider::class);
    }
}