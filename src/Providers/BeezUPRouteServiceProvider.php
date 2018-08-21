<?php
/**
 * BeezUPRouteServiceProvider.php
 *
 * @author Luis Ferrer <luis@bootdevelop.com>
 */

namespace BeezUP\Providers;
//https://github.com/plentymarkets/plugin-payment-cash-in-advance


use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class BeezUPRouteServiceProvider extends RouteServiceProvider
{

    /**
     * @param Router $router
     */
    public function map(Router $router )
    {

        $router->get('beezup-settings', 'BeezUP\Controllers\SettingsController@loadSettings');
    }

}