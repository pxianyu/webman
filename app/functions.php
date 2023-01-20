<?php

use support\Response;
use Tinywan\Captcha\Captcha;

/**
 * Here is your custom functions.
 */
function ok(string $message='操作成功',int $code=200,array $data=[]):Response
{
    $result=['code'=>$code,'message'=>$message,'data'=>$data];
    return new Response($code, ['Content-Type' => 'application/json'], json_encode($result, JSON_UNESCAPED_UNICODE));
}
function success(string $message,int $code=200): Response
{
    return ok($message,$code);
}
function successData(array $data,string $message='操作成功',int $code=200): Response
{
    return ok($message,$code,$data);
}
function error(string $message,int $code=400): Response
{
    return ok($message,$code);
}


/**
 * 转换字节数为其他单位
 *
 * @param string $filesize 字节大小
 *
 * @return    string    返回大小
 */
if ( ! function_exists('sizeCount')) {
    function sizeCount($filesize): string
    {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 .' MB';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 .' KB';
        } else {
            $filesize = $filesize.' Bytes';
        }

        return $filesize;
    }
}
/**
 * 验证码检查
 */
if (! function_exists('checkCode')){
    function checkCode($code,$key): bool
    {
        return false === Captcha::check($code,$key);
    }
}

if (! function_exists('returnData')){
    function returnData(string $msg,array $data=[],int $code=0): array
    {
        return ['code'=>$code,'data'=>$data, 'msg' => $msg];
    }
}