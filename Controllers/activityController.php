<?php

/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午4:18
 */
use Phalcon\Mvc\Controller;
class activityController extends Controller
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
        $act = new App\Models\Activity();
        $act = $act->findFirst("id = $id");
        
        if($act->delete()) {
            $this->sendJson('OK', 200 , "delete OK");
        } else {
            $this->sendJson('Fail',407, 'delete Not OK');
        }
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

    /**
     * 添加热门活动
     */
    public function addHot(){
        $sql = '';
        $arr = $this->request->getPost();
        foreach($arr as $k=>$v) {
            $sql.= "$k='".$v."',";
        }
        $sql = substr($sql,0,-1);
        $sql = "INSERT INTO hot_act SET ".$sql;
        $this->db->query($sql);
    }

    /**
     * 获取热门，即将完成和最新排队
     */
    public function getActIndex() {
        $sql = "SELECT * FROM hot_act h,activity a WHERE h.act_id = a.id";
        $hotAct = $this->db->fetchAll($sql);
        $sql = "SELECT * FROM activity WHERE act_have_done = 0 ORDER BY act_enough_user DESC ";
        $res = $this->db->fetchAll($sql);
        $soonAct = array_slice($res,0,3);
        foreach($res as $k=>$v) {
            $created_at[$k] = $v['created_at'];
        }
        array_multisort($created_at,SORT_DESC,$res);
        $newAct = array_slice($res,0,3);
        $actInfo = array();
        $actInfo['hotAct'] = $hotAct;
        $actInfo['soonAct'] = $soonAct;
        $actInfo['newAct'] = $newAct;
        $this->sendJson($actInfo,200,"OK");
        //$this->sendJson($,200,"OK");
    }
}























