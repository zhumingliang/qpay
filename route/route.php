<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::get('api/:version/index', 'api/:version.Index/index');

Route::get('api/:version/pay/qcode', 'api/:version.Pay/payQCode');
Route::get('api/:version/pay/hkd/qcode', 'api/:version.Pay/payWithHKD');
Route::get('api/:version/order/info', 'api/:version.Order/getInfo');
Route::get('api/:version/rate/update', 'api/:version.Rate/update');
Route::get('api/:version/pay/public', 'api/:version.Pay/payInPublic');

return [

];
