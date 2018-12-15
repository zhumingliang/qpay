<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/14
 * Time: 10:02 AM
 */

namespace qpay;


class QPayUnifiedOrder
{
    /**
     * @param \qpay\QpayDataBase $inputObj
     * @return mixed
     */
    public static function unifiedOrder($inputObj)
    {
        $url = "https://openapi.qfpay.com/trade/v1/payment";
        $data = $inputObj->getValues();
        $sign = $inputObj->setSign();
        $header[] = "X-QF-APPCODE: " . QpayConfig::$CODE;
        $header[] = "X-QF-SIGN: " . $sign;
        $result = self::post($url, $header,$data);
        return $result;
    }




    public  static function post($url, $header, $content)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 500);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);

        $ret = curl_exec($ch);
        curl_close($ch);
        return json_decode($ret);
    }

/*
    public static function post($url, $header, $content)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //TRUE-->将curl_exec()获取的信息以字符串返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //启用时会将头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_POST, true);
        //启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content, JSON_UNESCAPED_UNICODE));
        if (curl_exec($ch) === false) //curl_error()返回当前会话最后一次错误的字符串
        {
            die("Curlerror: " . curl_error($ch));
        }
        $response = curl_exec($ch);
        //获取返回的文件流
        curl_close($ch);
        return json_decode($response);
    }*/


}