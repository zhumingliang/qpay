<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/22
 * Time: 16:56
 */

namespace app\lib\exception;


class QpayException extends BaseException
{
    public $code = 401;
    public $msg = '获取二维码信息出错';
    public $errorCode = 10001;
}