<?php
namespace BeezUP\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Showcase\Extensions\TwigPluginStringUtils;
use Showcase\Extensions\TwigPluginTwigEscaper;

class BeezUPServiceProvider extends ServiceProvider
{
	/**
	 *
	 */
	public function register()
	{
		$this->getApplication()->register(\BeezUP\Providers\ShowcaseRestRouteServiceProvider::class);
		$this->getApplication()->register(\BeezUP\Providers\ShowcaseApiRouteServiceProvider::class);
		$this->getApplication()->register(\BeezUP\Providers\ShowcaseRouteServiceProvider::class);
	}

	/**
	 * @param Twig $twig
	 */
	public function boot(Twig $twig)
	{
		$twig->addExtension('Twig_Extensions_Extension_Intl');
		$twig->addExtension(TwigPluginStringUtils::class);
	}
}
