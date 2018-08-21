<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 8/08/18
 * Time: 11:06
 */

namespace BeezUP\Controllers;

use Plenty\Modules\Order\Services\OrderCreatedTypeService;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Plugin\Application;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Request;
use Plenty\Plugin\Http\Response;


use Plenty\Modules\Order\Models\Order;

class SettingsController extends Controller
{

    public function loadSettings(Response $response)
    {
       // $query = $this->db->query(Order::class);
        //$query->where('');
        return $response->json(array("test" => 1), 200);
    }

}