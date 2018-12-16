<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/15
 * Time: 6:12 PM
 */

namespace app\api\service;


class OrderService
{
    public function getOrderInfo()
    {
        $info = [
            'txamt' => 10,
            'txcurrcd' => 'HKD',
            'goods_name' => '测试商品',
            //'pay_tag'=>'ALIPAYHK'
        ];
        return $info;
    }

}