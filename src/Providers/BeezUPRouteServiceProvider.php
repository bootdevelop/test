<?php
/**
 * BeezUPRouteServiceProvider.php
 *
 * @author Luis Ferrer <luis@bootdevelop.com>
 */

namespace BeezUP\Providers;
//https://github.com/plentymarkets/plugin-payment-cash-in-advance

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;


class BeezUPRouteServiceProvider
{

    /**
     * @param Router $router
     */
    public function map(Router $router , ApiRouter $apiRouter)
    {

        $router->get('order/beezup/settings', 'BeezUP\Controllers\SettingsController@loadSettings');
    }

}