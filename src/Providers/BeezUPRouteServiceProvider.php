<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 21/07/18
 * Time: 19:37
 */

namespace BeezUP\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class BeezUPRouteServiceProvider extends RouteServiceProvider
{

    public function map(Router $router)
    {
        $router->get('hello','BeezUP\Controllers\ContentController@sayHello');
    }

}