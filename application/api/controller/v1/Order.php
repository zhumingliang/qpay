<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/15
 * Time: 6:20 PM
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\OrderService;

class Order extends BaseController
{

    /**
     * @api {GET} /api/v1/order/info  2-获取商品信息
     * @apiGroup  PC
     * @apiVersion 1.0.1
     * @apiDescription 获取商品信息
     * @apiExample {get}  请求样例:
     * http://qpay.mengant.cn/api/v1/order/info
     * @apiSuccessExample {json} 返回样例:
     * {"txamt":1,"txcurrcd":"HKD","goods_name":"测试商品"}
     * @apiSuccess (返回参数说明) {int} txamt 金额
     * @apiSuccess (返回参数说明) {String} txcurrcd 币种
     * @apiSuccess (返回参数说明) {String} goods_name 商品名称
     *
     * @return \think\response\Json
     */
    public function getInfo()
    {
        $info = (new OrderService())->getOrderInfo();
        return json($info);

    }

}