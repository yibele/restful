<?php

/**
 * Created by PhpStorm.
 * User: yibeel
 * Date: 17/6/14
 * Time: 下午5:21
 */
class user
{
    public function index () {
        echo "idnex";
    }

    public function show($id) {
        echo "show".$id;
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


}