<?php
use Phalcon\Mvc\Controller;
use App\Models\User;
use Phalcon\Mvc\Model\Resultset;
/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午5:21
 */
class userController extends Controller
{
    private $_errorCode = [
        '20010' => '保存用户错误',
        '10010' => '保存用户成功'
    ];

    public function index () {
        echo "idnex";
    }

    public function show($id) {
        $sql = "SELECT * FROM user WHERE id=$id";
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
        $arr = $this->request->getPost();
        $user = new App\Models\User();
        if($user->create($arr)){
            $this->response->setContent("100010");
        } else {
            $this->response->setStatusCode(406,'20010');
            $this->response->setContent("200010");
        };
        $this->response->send();
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
     * 获取用户登录状态
     */
    public function onLogin() {
        $code = $this->request->get('code');
        $appId = 'wx5539ee550defc662';
        $AppSecret = "3e79fc68202e4470535a4641dcdbb084";
        //发送到微信的api 中获取用户登录状态以及用户标识
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$AppSecret&js_code=$code&grant_type=authorization_code";
        $json = file_get_contents($url);
        print_r($json);
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
}