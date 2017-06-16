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

    public $created_at;

    public function initialize() {
        $this->belongsTo(
            'act_id',
            'App\\Models\\Activity',
            'id'
        );
        $this->belongsTo(
            'user_id',
            'App\\Models\\User',
            'id'
        );
    }

}