<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Goods extends controller
{
    // 商品详细信息
    public function detail($id=0)
    {
        echo    "商品id: " . $id;
        $goods = Db::table('p_goods')->field('goods_id,goods_name,shop_price')
            ->where('goods_id',$id)->find();
        $this->assign('goods_name',$goods['goods_name']);
        $this->assign('goods_price',$goods['shop_price']);
        return $this->fetch();
    }
}