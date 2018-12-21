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
   // public function payQCode()
    {

 /*       $url = 'https://openapi.qfpay.com';
        $api_type = '/trade/v1/payment';
        $mchid = "eqqmYMn0Zj6pncw5ZDxjgMqbzV"; //錢方提供的mchid
        $app_code = 'D75D13EE4719452698FA08359C28F63A'; //錢方提供的App Code
        $app_key = 'B6BF325B9E514FFDA1C6474C61BC9F87'; //錢方提供的App Key
        $now_time = date("Y-m-d H:i:s"); //獲取當前時間

        $fields_string = '';
        $fields = array(
            // 'mchid' => urlencode($mchid),
            'out_trade_no' => $this->GetRandStr(20),
            'pay_type' => 801501,
            'txamt' => 10,
            'txcurrcd' => 'HKD',
            'goods_name' => '测试商品',
            'txdtm' => $now_time
        );

        ksort($fields); //字典排序A-Z升序方式

        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = substr($fields_string, 0, strlen($fields_string) - 1); //刪除最後一個 & 符號

        $sign = strtoupper(md5($fields_string . $app_key));

        //// 設置Header ////
        $header = array();
        $header[] = 'X-QF-APPCODE: ' . $app_code;
        $header[] = 'X-QF-SIGN: ' . $sign;

        //Post Data去錢方海外URL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $api_type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $output = curl_exec($ch);
        curl_close($ch);

        //打印結果信息
        header('Content-type:text/json');
        $final_data = json_decode($output, true);
       return $this->qrcode($final_data['pay_url']);*/

          $res = (new PayService())->qCode($type,$id);
          return json($res);

    }


    // 二维码
    public function qrcode($qrData)
    {
        $savePath = dirname($_SERVER['SCRIPT_FILENAME']) . '/static/qrcode/';

        // $qrData = 'http://www.cnblogs.com/nickbai/';
        $qrLevel = 'H';
        $qrSize = '8';
        $savePrefix = 'NickBai';
        $filename = createQRcode($savePath, $qrData, $qrLevel, $qrSize, $savePrefix);

        return config('setting.img_prefix') . 'static/qrcode/' . $filename;


    }


    public function GetRandStr($length)
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
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


    public function wxPay()
    {


    }

}