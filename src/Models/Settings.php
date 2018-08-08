<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 8/08/18
 * Time: 11:09
 */

namespace BeezUP\Models;

use Plenty\Modules\Plugin\DataBase\Contracts\Model;

class Settings extends Model
{

    public $id;
    public $plentyId;
    public $name;
    public $value;
    public $updatedAt;

    public function getTableName()
    : string
    {
        return 'BeezUP::settings';
    }
}