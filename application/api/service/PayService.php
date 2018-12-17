<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/13
 * Time: 11:05 AM
 */

namespace app\api\service;


use app\api\model\OrderT;
use app\lib\exception\QpayException;
use qpay\QpayDataBase;
use qpay\QPayUnifiedOrder;


class PayService
{

    /**
     * @param $type
     * @return mixed
     * @throws QpayException
     */
    public function qCode($type)
    {
        $info = (new OrderService())->getOrderInfo();
        $qpayParam = new QpayDataBase();
        //$qpayParam->setTxamt($info['txamt']);//订单支付金额，单位分；
        $qpayParam->setTxamt(1);//订单支付金额，单位分；
       // $qpayParam->setTxcurrcd($info['txcurrcd']);//币种    港币：HKD ；人民币：CNY；日元：JPY；美元：USD；迪拉姆：AED；泰铢：THB
        $qpayParam->setTxcurrcd('CNY');//币种    港币：HKD ；人民币：CNY；日元：JPY；美元：USD；迪拉姆：AED；泰铢：THB
        $qpayParam->setPayType($type);// 微信扫码:800201；支付宝扫码:800101
        $qpayParam->setOuTradeNo(time());// 外部订单号，开发者平台订单号，同子商户（mchid）下，每次成功调用支付（含退款）接口，该参数值均不能重复使用,保证单号唯一，长度不超过128字符
        $qpayParam->setTxdtm(date('Y-m-d H:i:s'));// 请求交易时间格式为：格式为：YYYY-MM-DD HH:MM:SS
        $qpayParam->setGoodsName($info['goods_name']);//商品名称或标示，建议不超过20字，不含英文逗号等特殊字符
        // $qpayParam->setPayTag($info['pay_tag']);//商品名称或标示，建议不超过20字，不含英文逗号等特殊字符
        $res = QPayUnifiedOrder::unifiedOrder($qpayParam);
        $data = $qpayParam->getValues();
        $data['q_res'] = json_encode($res);
        $this->saveOrder($data);
        if ($res->respcd != '0000') {
            throw  new QpayException();
        }
        return [
            'qrcode' => $this->qrcode($res->qrcode)
        ];


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

        return config('setting.img_prefix').'static/qrcode/' . $filename;


    }

    private
    function saveOrder($data)
    {
        OrderT::create($data);
    }

}