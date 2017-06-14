<?php
use Phalcon\Mvc\Controller;
/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午4:18
 */
class activity extends Controller
{
    public function index () {
        $sql = "SELECT * FROM activity";
        $res = $this->db->fetchAll($sql);
        $this->sendJson($res);

    }
    public function show($id) {
        $sql = "SELECT * FROM activity WHERE id=$id";
        $res = $this->db->fetchOne($sql);
        if($res){
            $this->sendJson($res);
        } else {
            $this->sendJson($res,406,"No Data Here");
        }
    }

    /**
     * 添加活动
     */

    public function add() {
        echo "add";
    }

    /**
     * 更新活动
     */
    public function update($id) {
        echo "update".$id;
    }

    /**
     * 删除活动
     */

    public function delete($id) {
        echo "delete".$id;
    }

    /**
     * 发送Json数据
     */
    public function sendJson($res,$statCode=200,$comment='ok') {
        $this->response->setStatusCode($statCode,$comment);
        $this->response->setJsonContent([
            "status" => $comment,
            "data" => $res,

        ]);
        $this->response->send();
    }
}