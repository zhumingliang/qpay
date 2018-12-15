<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/13
 * Time: 11:04 AM
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\PayService;

class Pay extends BaseController
{
    /**
     * @api {GET} /api/v1/pay/qcode  1-获取支付二维码
     * @apiGroup  MINI
     * @apiVersion 1.0.1
     * @apiDescription
     * @apiExample {get}  请求样例:
     * http://mengant.cn/api/v1/pay/qcode?type=800201
     * @apiParam (请求参数说明) {String} type 订单类别：微信扫码:800201；支付宝扫码:800101
     * @apiSuccessExample {json} 返回样例:
     * {"qrcode":"weixin:\/\/wxpay\/bizpayurl?pr=aHI6KOn"}
     * @apiSuccess (返回参数说明) {String} qrcode 扫码支付跳转连接。你需要生成一张二维码，扫码跳转到这个连接
     *
     * @param int $type
     * @return \think\response\Json
     * @throws \app\lib\exception\QpayException
     */
    public function payQCode($type = 800201)
    {
        $res = (new PayService())->qCode($type);
        return json($res);

    }

    public function wxPay()
    {

    }

}