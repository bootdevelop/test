<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 8/08/18
 * Time: 11:06
 */

namespace BeezUP\Controllers;

use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;


class SettingsController extends Controller
{


    public function loadSettings(Request $request): string {

        return json_encode(array("test" => "test"));
    }

}