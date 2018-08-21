<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 8/08/18
 * Time: 11:06
 */

namespace BeezUP\Controllers;


use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;


class SettingsController extends Controller
{


    public function loadSettings(Twig $twig) :string {
        return $twig->render("BeezUP::Index");
    }

}