<?php
namespace BeezUP\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class BeezUPRestRouteServiceProvider extends RouteServiceProvider
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

		$router->get('rest-doc/introduction', 'BeezUP\Controllers\RestController@showRestIntroduction')
			->where('moduleName', '[a-zA-Z_]+');

		$router->get('rest-doc/{moduleName}', 'BeezUP\Controllers\RestController@showRestModule')
			->where('moduleName', '[a-zA-Z_]+');

		$router->get('rest-doc/{moduleName}/details', 'BeezUP\Controllers\RestController@showRestModuleDetail')
			->where('moduleName', '[a-zA-Z_]+');
	}
}
