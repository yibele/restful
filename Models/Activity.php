<?php

namespace App\Models;
use Phalcon\Mvc\Model;

class Activity extends model
{
    public $Id;

    public $act_user;

    public $created_at;

    public $act_title;

    public $act_content;

    public $act_location;

    public $act_type;

    public $act_time;

    public $act_user_need;

    public $act_wechat;

    public $act_review;

    public $act_have_done;

    public $act_enough_user;


    //初始化操作，只运行一次
    public function initialize() {
        //默认情况下table名就是class那么， 如果需要自己设定，就得调用setSource 方法
        $this->setSource('activity');
    }

    //每次被创建的时候都会被启用
    public function onConstruct() {
    
    }

    public function beforeSave() {
        $this->created_at = date("Y-m-d H:i:s");
        $this->act_review = 0;
        $this->act_have_done = 0;
        $this->act_enough_user = 0;
        $this->act_type = '默认' ;

    }
}
