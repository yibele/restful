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
        for ($i = 0; $i < count($this->_allowResource); $i++) {
            $getUrl = "/api/" . $this->_allowResource[$i];
            $showUrl = "/api/" . $this->_allowResource[$i] . "/{id:[0-9]+}";
            $controller = new $this->_allowResource[$i];
            $this->_app->get(
                $getUrl,
                [
                    $controller,
                    'index'
                ]
            );
            $this->_app->get(
                $showUrl,
                [
                    $controller,
                    'show'
                ]
            );
            $this->_app->post(
                $getUrl,
                [
                    $controller,
                    'add'
                ]
            );
            $this->_app->put(
                $showUrl,
                [
                    $controller,
                    'update'
                ]
            );
            $this->_app->delete(
                $showUrl,
                [
                    $controller,
                    'delete'
                ]
            );
        }
    }

    private function _render()
    {
        $this->_app->handle();
    }

}