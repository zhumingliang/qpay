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
use wxpay\PayNotifyCallBack;

class Pay extends BaseController
{
    /**
     * @api {GET} /api/v1/pay/qcode  1-获取支付二维码
     * @apiGroup  PC
     * @apiVersion 1.0.1
     * @apiDescription  获取支付二维码
     * @apiExample {get}  请求样例:
     * http://qpay.mengant.cn/api/v1/pay/qcode?type=800201
     * @apiParam (请求参数说明) {String} type 订单类别：微信扫码:800201；支付宝扫码:800101
     * @apiSuccessExample {json} 返回样例:
     * {"qrcode":"weixin:\/\/wxpay\/bizpayurl?pr=aHI6KOn"}
     * @apiSuccess (返回参数说明) {String} qrcode 扫码支付跳转连接。你需要生成一张二维码，扫码跳转到这个连接
     *
     * @param int $type
     * @return \think\response\Json
     * @throws \app\lib\exception\QpayException
     */
    public function payQCode($type = 800201, $id)
    {
        $res = (new PayService())->qCode($type, $id);
        return json($res);

    }

    public function receiveNotify()
    {
        $notify = new PayNotifyCallBack();
        $notify->handle(true);
        if ($notify->getReturnCode() == 'SUCCESS') {
            $attach = $notify->getAttach();
            $attach_arr = explode("#", $attach);
            $order_id = $attach_arr[0];
            $type = $attach_arr[1];
            $pay = new PayService($order_id, $type, '');
            $res = $pay->receiveNotify($notify);
            if ($res) {
                return '<xml>
              <return_code><![CDATA[SUCCESS]]></return_code>
              <return_msg><![CDATA[OK]]></return_msg>
          </xml>';
            }

        }


    }


    public function payInPublic()
    {

    }


    /**
     * @api {GET} /api/v1/pay/hkd/qcode  2-获取港币支付二维码
     * @apiGroup  PC
     * @apiVersion 1.0.1
     * @apiDescription  获取港币支付二维码
     * @apiExample {get}  请求样例:
     * http://qpay.mengant.cn/api/v1/pay/hkd/qcode?cny=888&rate=88&hkd=100&name=商品名称&type=1
     * @apiParam (请求参数说明) {String} cny 人民币金额:单位分
     * @apiParam (请求参数说明) {String} rate 港币换个人民币汇率
     * @apiParam (请求参数说明) {String} hkd 港币金额：单位分
     * @apiParam (请求参数说明) {String} name 商品名称
     * @apiParam (请求参数说明) {int} type 支付类别：1 | 微信；2 | 支付宝
     * @apiSuccessExample {json} 返回样例:
     * {"qrcode":"weixin:\/\/wxpay\/bizpayurl?pr=aHI6KOn"}
     * @apiSuccess (返回参数说明) {String} qrcode 扫码支付跳转连接。你需要生成一张二维码，扫码跳转到这个连接
     *
     * @param $cny
     * @param $rate
     * @param $hkd
     * @param $name
     * @param $type
     * @return \think\response\Json
     * @throws \app\lib\exception\QpayException
     */
    public function payWithHKD($cny, $rate, $hkd, $name, $type)
    {
        $qrcode = (new PayService())->payWithHKD($cny, $rate, $hkd, $name, $type);
        return json([
            'qrcode' => $qrcode
        ]);

    }

}