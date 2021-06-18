<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\facade\Session;

class Info extends Controller
{
    public function more()
    {
        /**
         * // 获取消费最多的前十个用户
         *
         * $cons = Db::table('p_order_info')->alias('b')
         *  ->field('a.user_id,a.user_name,a.reg_time,sum(b.goods_amount) as total')
         *  ->join('p_users a','a.user_id = b.user_id')
         *  ->group('b.user_id')
         *  ->order('total','desc')
         *  ->limit(10)
         *  ->select();
         *
         */

        /**
         *
         * // 订单最多的前十个用户信息
         * $cons = Db::table('p_order_info')->alias('b')
         *  ->field('a.user_id,a.user_name,count(b.user_id) as shop')
         *  ->join('p_users a','a.user_id = b.user_id')
         *  ->group('b.user_id')
         *  ->order('shop','desc')
         *  ->limit(10)
         *  ->select();
         */


        /**
         * // 订单的平均金额
         *  $avg = Db::table('p_order_info')->avg('goods_amount');
         *  // 用千分位展示平均金额
         *  $a = ;
         *  echo $a;
         */




        // 人均消费
        $a = Db::table('p_order_info')->field('count(distinct user_id)')->select();
        $b = $a[0]['count(distinct user_id)'];
        echo "<pre>";
        print_r($b);
        echo "</pre>";
        $cons = Db::table('p_order_info')->sum('goods_amount');

        $avg =  number_format($cons/$b,2);
        echo $avg;




        $this->assign('cons',$cons);
        return $this->fetch();
    }
}
