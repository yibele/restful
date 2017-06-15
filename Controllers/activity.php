<?php

/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午4:18
 */
use Phalcon\Mvc\Controller;
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
        $activity = new App\Models\Activity();
        $arr = $this->request->getPost();
        $this->_checkFields($arr);

        if($activity->create($arr) === true) {
            $this->sendJson("success", 200 , 'OK');
        } else {
            $messages = $activity->getMessages();
            foreach($messages as $mes) {
                $res[] = $mes; 
                $statusCode = 406;
                $comment = "activity create fail";
            }
            $this->sendJson($res, 407, 'Create Activity Fial');
        }
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
            "data" => $res
        ]);
        $this->response->send();
    }

    /**
     * 检查数据列是否存在与表中
     */
    private function _checkFields($args) {
        $fields = array();
        $sql = "SHOW COLUMNS FROM activity";
        $res = $this->db->fetchAll($sql);

        foreach ($res as $v) {
            $fields[] = $v['Field'];
        }

        foreach ($args as $k => $v) {
            if(!in_array($k, $fields)) {
                exit("Mysql Query Error : Unkown column '$k' in fileds list");
            }
        }
    }
}























