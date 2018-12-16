<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/12/14
 * Time: 10:06 AM
 */

namespace qpay;

/**
 * 统一下单输入对象
 * Class QpayDataBase
 * @package qpay
 */

class QpayDataBase
{
    protected $values = array();
    var $returnParameters;//返回参数，类型为关联数组


    /**
     * 设置 订单支付金额，单位分
     * @param $value
     */
    public function setTxamt($value)
    {
        $this->values['txamt'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getTxamt()
    {
        return $this->values['txamt'];
    }


    /**
     * 设置 币种
     * @param $value
     */
    public function setTxcurrcd($value)
    {
        $this->values['txcurrcd'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getTxcurrcd()
    {
        return $this->values['txcurrcd'];
    }


    /**
     * 设置 支付类型
     * @param $value
     */
    public function setPayType($value)
    {
        $this->values['pay_type'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getPayType()
    {
        return $this->values['pay_type'];
    }


    /**
     * 设置 外部订单号
     * @param $value
     */
    public function setOuTradeNo($value)
    {
        $this->values['out_trade_no'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getOuTradeNo()
    {
        return $this->values['out_trade_no'];
    }



    /**
     * 设置 请求交易时间
     * @param $value
     */
    public function setTxdtm($value)
    {
        $this->values['txdtm'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getTxdtm()
    {
        return $this->values['txdtm'];
    }

    /**
     * 设置 商品名称或标示
     * @param $value
     */
    public function setGoodsName($value)
    {
        $this->values['goods_name'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getGoodsName()
    {
        return $this->values['txdtm'];
    }


    /**
     * 设置 子商户号，标识子商户身份
     * @param $value
     */
    public function setMchid($value)
    {
        $this->values['mchid'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getMchid()
    {
        return $this->values['mchid'];
    }

    /**
     * 设置 子商户号，标识子商户身份
     * @param $value
     */
    public function setPayTag($value)
    {
        $this->values['pay_tag'] = $value;
    }

    /**
     * @return string 值
     **/
    public function getPayTag()
    {
        return $this->values['pay_tag'];
    }

    /**
     * 设置签名，详见签名生成算法
     * @return string 签名
     */
    public function setSign()
    {
        $sign = $this->makeSign();
        $this->values['sign'] = $sign;
        return $sign;
    }

    /**
     * 获取签名，详见签名生成算法的值
     * @return string 值
     **/
    public function getSign()
    {
        return $this->values['sign'];
    }



    /**
     * 生成签名
     * @return string 签名，本函数不覆盖sign成员变量，如要设置签名需要调用setSign方法赋值
     */
    public function makeSign()
    {
        //签名步骤一：按字典序排序参数
        ksort($this->values);
        $string = $this->toUrlParams();
        //签名步骤二：在string后加入KEY
        $string = $string . QpayConfig::$KEY;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        //$result = strtoupper($string);
        return $string;
    }

    /**
     * 格式化参数格式化成url参数
     */
    public function toUrlParams()
    {
        $buff = "";
        foreach ($this->values as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 获取设置的值
     */
    public function getValues()
    {
        return $this->values;
    }

}