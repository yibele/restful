<?php
/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/16
 * Time: 下午5:16
 */
namespace App\Models;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model;

class User extends Model
{
    public function validation () {
        $validator = new Validation();

        $validator->add(
            'openId',
            new Uniqueness(
                [
                    'message' => 'the openId must be unique',
                ]
            )
        );
        return $this->validate($validator);
    }

    public $userInfo;

    public $openId;



}