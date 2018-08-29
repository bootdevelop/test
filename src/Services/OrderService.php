<?php
/**
 * OrderService.php
 *
 * @author Luis Ferrer <luis@bootdevelop.com>
 */

namespace BeezUP\Services;

use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Plugin\Application;
use Plenty\Modules\Order\Models\Order;
use Plenty\Modules\Account\Address\Models\Address;

class OrderService
{

    //** @var Application  */
    private $app;
    /** @var  DataBase */
    private $db;

    public function __construct(Application $app, DataBase $db)
    {
        $this->app = $app;
        $this->db  = $db;
    }


//    private function createOrder() {
//        //https://developers.plentymarkets.com/api-doc/Order
//        /**
//         * @var $order Order
//         */
//        $order = pluginApp(Order::class);
//        $order->typeId = 1;
//        $order->lockStatus = 'unlocked';
//
//        $this->db->save($order);
//        return $order;
//    }
//
//
//    private function createAddress() {
//        //https://developers.plentymarkets.com/api-doc/account#account_models_address
//        /**
//         * @var $address Address
//         */
//        $address = pluginApp(Address::class);
//        $address->gender = 'male|female';
//        $address->name1 = "Company";
//        $address->name2 = "Luis Ferrer";
//        $address->name3 = "Last Name";
//        $address->name4 = "...";
//        //$address->companyName = "Bootdevelop";
//        //$address->firstName = "Luis";
//        //$address->lastName = "Ferrer";
//        $address->address1 = "...";
//        $address->address2 = "...";
//        $address->address3 = "...";
//        $address->address4 = "...";
//        $address->postalCode = "080172";
//        $address->countryId = 1;
//        $address->stateId = 1;
//        //$address->
//
//    }


}