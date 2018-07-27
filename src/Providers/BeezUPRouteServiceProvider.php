<?php

namespace BeezUP\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class BeezUPRouteServiceProvider extends RouteServiceProvider
{
    /**
     *
     */
    public function register()
    {
    }

    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get('', 'BeezUP\Controllers\ContentController@showLandingPage');
        $router->get('search', 'BeezUP\Controllers\ContentController@showSearchResults');
        $router->get('tutorials/{tutorialsPage}', 'BeezUP\Controllers\ContentController@showTutorials');
        $router->get('dev-doc/{devGuidePage}', 'BeezUP\Controllers\ContentController@showDevGuidePage');
        $router->get('marketplace/{marketplacePage}', 'BeezUP\Controllers\ContentController@showMarketplacePage');
        $router->get('terra-doc/{terraPage}', 'BeezUP\Controllers\ContentController@showTerraPage');
        $router->get('rest-doc', 'BeezUP\Controllers\ContentController@showPlentymarketsApiDoc');
		$router->get('downloads/openapi', 'BeezUP\Controllers\ContentController@downloadApiJson');
        $router->get('plentybase-doc', 'BeezUP\Controllers\ContentController@showPlentybaseApiDoc');
    }
}
