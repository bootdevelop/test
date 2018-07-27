<?php
namespace BeezUP\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class BeezUPApiRouteServiceProvider extends RouteServiceProvider
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
		$router->get('api-doc/{module}', 'BeezUP\Controllers\ApiDocController@showApiModule');
	}
}
