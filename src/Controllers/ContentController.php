<?php //strict

namespace BeezUP\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use BeezUP\Services\PluginApiChangelog;
use BeezUP\Services\DownloadJsonApi;
use Plenty\Plugin\Http\Request;

class ContentController extends Controller
{
    /**
     * @param Twig $twig
     * @param PluginApiChangelog $pluginApiChangelog
     * @return string
     */
    public function showLandingPage(Twig $twig, PluginApiChangelog $pluginApiChangelog): string
    {
        $changelogEntries = $pluginApiChangelog->getChangelog();

        return $twig->render('PlentyPluginShowcase::content.LandingPage', ['changelog' => $changelogEntries]);
    }

    /**
     * @param Twig $twig
     * @return string
     */
    public function showSearchResults(Twig $twig): string
    {
        return $twig->render('PlentyPluginShowcase::content.GoogleSearch');
    }

    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showTutorials(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.tutorials.' . $pageName);
    }

    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showDevGuidePage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.devguide.' . $pageName);
    }

    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showMarketplacePage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.marketplace.' . $pageName);
    }

    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showTerraPage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::terra.' . $pageName);
    }

    /**
     * @param Twig $twig
     * @return string
     */
    public function showPlentymarketsApiDoc(Twig $twig): string
    {
        return $twig->render('PlentyPluginShowcase::swagger-ui.plentymarkets.openAPIv2');
    }

    /**
     * @param Twig $twig
     * @return string
     */
    public function showPlentybaseApiDoc(Twig $twig): string
    {
        return $twig->render('PlentyPluginShowcase::swagger-ui.plentybase.openAPIv2');
    }

    /**
     * @return string
     */
    public function downloadApiJson(Request $request)
    {
        $type = $request->get('type');

        $url = '';
        if ($type == 'plentymarkets') {
            $url = 'https://raw.githubusercontent.com/plentymarkets/api-doc/master/plentymarkets/openApiV2/openApiV2.json';
        } elseif ($type == 'plentybase') {
            $url = 'https://raw.githubusercontent.com/plentymarkets/api-doc/master/plentyBase/openApiV2/openApiV2.json';
        }

        $downloadApi = pluginApp(DownloadJsonApi::class);

        return $downloadApi->getJson($url);
    }
}
