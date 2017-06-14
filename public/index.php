<?php
use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;



/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午4:12
 */


$loader = new Loader();
$loader->registerDirs ([
    '../Controllers',
    '../Models',
    '../Router'

]);
$loader->register();
$di = new FactoryDefault();
$di->setShared(
    "db",
    function () {
        return new Mysql([
            "host" => '127.0.0.1',
            'dbname' => 'xyp',
            'prot' => '3306',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ]);
    }
);

$activity = new activity();

$app = new Micro();

//注册路由以及验证
$router = new router();
$router->setApp($app);

$router->init();












