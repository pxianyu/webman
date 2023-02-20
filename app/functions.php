<?php

use Shopwwi\WebmanAuth\Facade\Auth;
use support\Response;
use Tinywan\Captcha\Captcha;

/**
 * Here is your custom functions.
 */
function ok(string $message='操作成功',int $code=200,array $data=[]):Response
{
    $result=['code'=>$code,'message'=>$message,'data'=>$data];
    return new Response($code, ['Content-Type' => 'application/json'], json_encode($result, JSON_UNESCAPED_UNICODE||JSON_FORCE_OBJECT));
}
function success(string $message,int $code=200): Response
{
    return ok($message,$code);
}
function successData(array $data,string $message='操作成功',int $code=200): Response
{
    return ok($message,$code,$data);
}
function error(string $message='操作失败',int $code=400): Response
{
    return ok($message,$code);
}
function successJsonData(object $data ,string $message='操作成功',int $code=200):Response
{
    $result=['code'=>$code,'message'=>$message,'data'=>$data];
    return new Response($code, ['Content-Type' => 'application/json'], json_encode($result, JSON_UNESCAPED_UNICODE||JSON_FORCE_OBJECT));
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
if (! function_exists('getUserId')){
    function getUserId()
    {
        $user=Auth::guard('admin_api')->user(true);
        if (!$user){
            return  null;
        }
        return $user['id'];
    }
}

function paginate($data): Response
{
    $res['total']=$data->total();
    $res['data']=$data->items();
    $res['current_page']=$data->currentPage();
    $res['lastPage']=$data->lastPage();
    return successData($res);
}