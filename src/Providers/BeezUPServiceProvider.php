<?php

namespace BeezUP\Providers;

use Plenty\Plugin\ServiceProvider;


class BeezUPServiceProvider extends ServiceProvider {

    public function register() {
        $this->getApplication()->register(BeezUPRouteServiceProvider::class);
    }

}