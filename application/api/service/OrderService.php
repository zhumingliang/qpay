<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/15
 * Time: 6:12 PM
 */

namespace app\api\service;


use app\api\model\GoodsT;

class OrderService
{
    public function getOrderInfo($id)
    {


        $info = GoodsT::where('id', $id)->find();
        return $info;

       /* $info = [
            'txamt' => 10 / 100,
            'txcurrcd' => 'rmb',
            'goods_name' => '测试商品',
            'pay_tag' => 'alipaycn'
        ];*/
    }

}