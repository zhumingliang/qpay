<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/26
 * Time: 1:35 AM
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\RateT;
use app\lib\exception\QpayException;

class Rate extends BaseController
{
    public function update($rate)
    {
        $res = RateT::update(['rate' => $rate], ['id' => 1]);
        if (!$res) {
            throw new QpayException(
                ['code' => 401,
                    'msg' => '修改汇率失败',
                    'errorCode' => 40001
                ]
            );
        }

        return json([
            'msg' => '当前汇率为：' . $rate]);

    }

}