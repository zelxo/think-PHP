<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Session;
class User extends Controller
{

    /*
     * 用户注册  前台展示
     * */
    public function reg()
    {
        return $this->fetch();
    }

    /*
     * 用户注册逻辑
     * */
    public function reg2()
    {
        // 判断为空时die掉
        if (in_array(null,$_POST)){
            die("请填入注册内容");
        }
        // 处理变量
        $pass = trim($_POST['u_pass1']);
        $passWord = password_hash($pass,PASSWORD_BCRYPT);
        // 定义一个关联数组
        $data = [
            'userName' => trim($_POST['u_name']),
            'userEmail' => trim($_POST['u_email']),
            'userMobile' => trim($_POST['u_mobile']),
            'userEge' => trim($_POST['u_age']),
            'userPass' => $passWord,
            'address' => trim($_POST['u_address'])
        ];

        $sql = Db::table('reg')->insert($data);



    }

    /*
     *  用户登录  前台展示
     * */
    public function login()
    {

        return $this->fetch();
    }

    /*
     * 用户登录逻辑
     * */
    public function login2()
    {
        $pass = trim($_POST['pass']);
        $sql = Db::table('reg')->where("userName" , "{$_POST['u']}" )->find();
        if ($sql){
            if (password_verify($pass,$sql['userPass'])) {
                // 定义一个管理数组
                $history = [
                    "uid" => $sql['userId'],
                    "loginTime" => time(),
                    "loginIP" => $_SERVER['REMOTE_ADDR'],
                    "ua" => $_SERVER['HTTP_USER_AGENT']
                ];

                Db::table('login_history')->insert($history);
                // 定义一个会话
                Session::set('uid',$sql['userId']);
                Session::set('userName',$sql['userName']);
                return redirect('/center/center');
            }else{
                echo "密码错误";
            }
        }else{
            echo "登录失败";
        }
    }




    /*
     * 个人中心
     * */
    public function center()
    {

        $arr = Session::get();
        if (empty($arr)){
            return redirect("/login/login");
        }

        $id = $arr['uid'];

        $sql = Db::table('reg')->where('userId',$id)->find();

        $history = Db::table("login_history")->where('uid',$id)->limit(10)->select();

        foreach ($history as $k => $v) {
            $history[$k]['loginTime'] = date("Y-m-d H:i:s",$v['loginTime']);
        }


        $this->assign('name',$sql['userName']);
        $this->assign('email',$sql['userEmail']);
        $this->assign('mobile',$sql['userMobile']);
        $this->assign('Ege',$sql['userEge']);
        $this->assign('address',$sql['address']);
        $this->assign('history',$history);

        return $this->fetch();
    }



    /*
     * 退出登录*/
    public function out()
    {
        // 删除session
        Session::delete('uid');
        Session::delete('userName');
        // 跳转登录页面
        return redirect('/login/login');
    }



    /*
     *
     * 电影评分
     */

    public function movie()
    {


        $movie = Db::table('movie')->select();
        $this->assign('movie',$movie);

        $avg = Db::table('movie_score')->
        field('avg(movie_score)')->
        group('movie_id')->select();

        $this->assign('avg',$avg);
        return $this->fetch();
    }



    public function movieScore()
    {
        $ses = Session::get();

        if (empty($ses)){
            echo    "请先登录";
            die;
            $this->success('请先登录','/login/login');
        }

        $movie =  Db::table('movie')->select();

        foreach ($movie as $k=>$v){
            $s = $_POST['num'][$k+1];
            if ($s == 0 || $s < 0 || $s > 100){
                die('输入内容不符合规范');
            }

            $data = [
                "movie_id"      =>  $k,
                "movie_score"   =>  $_POST['num'][$k+1],
                "uid"           =>  $_SESSION['think']['uid']
            ];
            Db::table('movie_score')->insert($data);
            // $avg = Db::table('movie_score')->where('movie_score',$_POST['num'][$k+1])->avg('movie_score');
            return redirect('/movie/movie');
        }

    }







    // 抽奖
    public function prize()
    {
        $ses = Session::get();
        echo "<pre>";
        print_r($ses);
        echo "</pre>";
        if (empty($ses)){
            die("请先登录");
        }
        $res = Db::table('prize')->select();
        echo "欢迎: " . $ses['userName'];
        echo "<hr>";
        $chars = "1234567890qwueiqweusahdwniteposfdskndWEjsdnwsidfiewlkjweiusadnisadsakjdsauioquwensndhjfgkjdghgrpdiof";
        //
        $charsLen = strlen($chars) - 1;
        str_shuffle($chars);
        $output = "";
        $output = $chars[mt_rand(0, $charsLen)];
        $qq =  Db::table('prize')->where('prize',$output)->select();
        $now = time();
        $time = $now - 60;
        $cj = Db::table('prize')->where('uid',$ses['uid'])->where('add_time','>',$time)->count();
        // if ($cj >= 3 ){
        //     echo '抽奖次数受限制';
        //     die;
        // }
        if ($qq){
            $output = mt_rand(6,100);
            echo "很遗憾未中奖";echo "<br>";
        }else if ($output == 1){
            echo "恭喜获得一等奖,二十元人民币奖励！！！";echo "<br>";
        }else if ($output == 2 || $output == 3 ){
            echo "恭喜获得二等奖,十元人民币奖励！！！";echo "<br>";
        }else if ($output == 4 || $output == 5 || $output == 6){
            echo "恭喜获得三等奖,五元人民币奖励！！！";echo "<br>";
        }else {
            echo "很遗憾未中奖";echo "<br>";
        }
        $data = [
            'uid'       => $ses['uid'],
            'add_time'  => time(),
            'prize'     => $output
        ];
        $sql = Db::table('prize')->insert($data);
        $this->assign('output',$output);
        return $this->fetch();

    }




    /*
     * 预定座位*/

    public function reservation()
    {
        $seat = Db::table('seat')->select();

        $this->assign('seat',$seat);
        return $this->fetch();
    }


    public function choose()
    {


        if (empty($_POST['seat_num'])){
            echo $this->error('请输入预定座位','/seat/reservation');
        }


        $ses = Session::get();


        if (empty($ses)){
            echo $this->error('请先登录后再预定','/login/login');

        }



        Db::table('seat')->where('seat_num',$_POST['seat_num'])->select();

        $now = time();
        $sale = Db::table('seat')->field('sale')->select();

        $s = $_POST['seat_num']-1;
        if ($sale[$s]['sale'] == 1){
            echo "该座位已经被预定了";
            echo $this->error('座位已经被预定了,请重新选择','/seat/reservation');
        }

        Db::table('seat')->where('seat_num',$_POST['seat_num'])->update(['uid'=>$ses['uid'],'time'=>$now,'sale'=>1]);
        echo $this->success('预定成功正在跳转您的预定页面','/seat/my');
    }


    public function my()
    {
        $ses = Session::get();
        $num = Db::table('seat')->field('seat_num,time')->where('uid',$ses['uid'])->select();
        $this->assign('seat',$num);

        return $this->fetch();
    }








}
