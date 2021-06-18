<?php

namespace app\index\controller;
use think\model;
use think\Controller;
use think\facade\Request;
// 引入Users模型   在起个别名UsersModel
use app\index\model\Users as UsersModel;

class Users extends Controller
{

    /**
     * 通过模型获取用户列表
     */
    public function test1()
    {
        // 获取userId为1 的一条数据
        // 使用select
        $u = UsersModel::where('userid',1)->select();
        echo "<pre>";
        print_r($u[0]);
        echo "</pre>";
        $a = $u[0];

        // 获取配置信息
        config();

        // 调试输出  类似于var_dump
        $name = $a->userName;
        dump($name);




        echo "用户id为 ：" . $a->userName;echo "<br>";
        echo "用户邮箱为 ：" . $a->userEmail;echo "<br>";
        echo "用户手机号为 ：" . $a->userMobile;echo "<br>";
        echo "用户年龄为 ：" . $a->userEge;echo "<br>";
        echo "用户地址为 ：" . $a->address;echo "<br>";
    }


    public function test2()
    {
        if (empty($_GET)){
            return $this->fetch();
        }

        // 接收POST和GET传参
        $post = $this->request->param();
        echo "<pre>";
        print_r($post);
        echo "</pre>";


        $u = new UsersModel([
            'userName' => $post['userName'],
            'userEmail' => $post['userEmail'],
            'userMobile' => $post['userMobile'],
            'userEge' => $post['userEge'],
            'address' => $post['address']
        ]);
        $u->save();

    }
}
