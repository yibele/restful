<?php
use \Phalcon\Mvc\Controller;

/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午4:48
 */
class router extends Controller
{
    private $_app;
    //服务器允许访问的资源
    private $_allowResource = ['activity', 'user'];

    //当前获取的请求方法
    private $_method = '';


    //当前请求的资源
    private $_resource = '';


    //服务器允许访问的方法
    private $_allowMethods = ['GET', 'PUT', 'POST', 'DELETE'];

    //注入micro app 对象
    public function setApp($app)
    {
        $this->_app = $app;
    }

    //初始化
    public function init()
    {
        //初始化请求资源、检查请求资源
        $this->_checkResource();
        //初始化请求方法、检查请求方法
        $this->_checkMethods();
        //设置路由
        $this->_setRouter();
        //启动路由
        $this->_render();
    }

    private function _checkResource()
    {
        $resource = $this->request->getURI();
        $arr = explode('/', $resource);
        $this->_resource = $arr[2];
        unset($arr);
        if (!in_array($this->_resource, $this->_allowResource)) {
            $this->response->setStatusCode(405, "No Such Resource! ");
            $this->response->setContent("Resource Is Valid");
            $this->response->send();
            exit;
        }
    }


    private function _checkMethods()
    {
        $this->_method = $this->request->getMethod();
        if (!in_array($this->_method, $this->_allowMethods)) {
            $this->response->setStatusCode(405, "Methods not Allow");
            $this->response->setContent("Methods not Allow");
            $this->response->send();
            exit;
        }
    }

    private function _setRouter()
    {
        $this->_app->notFound(function () {
            $this->response->setStatusCode(404, "Page Not Found");
            $this->response->setContent("Page Not Found, plase check your url");
            $this->response->send();
            exit;
        });

        $act = new activityController();
        $user = new userController();

        $this->_app->post(
            '/api/activity/addHot',
            [
                $act,
                'addHot'
            ]
        );

        $this->_app->get(
            '/api/user/onLogin',
            [
                $user,
                'onLogin'
            ]
        );

        $this->_app->get(
            '/api/activity',
            [
                $act,
                'index'
            ]
        );

        $this->_app->get(
            '/api/activity/{id:[0-9]+}',
            [
                $act,
                'show'
            ]
        );

        $this->_app->post(
            '/api/activity',
            [
                $act,
                'add'
            ]
        );

        $this->_app->put(
            '/api/activity/{id:[0-9]+}',
            [
                $act,
                'update'
            ]
        );

        $this->_app->delete(
            '/api/activity/{id:[0-9]+}',
            [
                $act,
                'delete'
            ]
        );

        $this->_app->post(
            '/api/user',
            [
                $user,
                'add'
            ]
        );

        $this->_app->put(
            '/api/user/{id:[0-9]+}',
            [
                $user,
                'update'
            ]
        );

        $this->_app->get(
            '/api/user/{id:[0-9]+}',
            [
                $user,
                'show'
            ]
        );

        $this->_app->get(
            '/api/user',
            [
                $user,
                'index'
            ]
        );
    }

    private function _render()
    {

        $this->_app->handle();
    }

}