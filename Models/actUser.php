<?php
/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/16
 * Time: 下午7:10
 */
namespace App\Models;
use Phalcon\Mvc\Model;


class actUser extends Model
{
    public $id;

    public $act_id;

    public $nickName;

    public $created_at;

}