<?php
declare(strict_types=1);
namespace app\Services\Auth;

use app\Request\Admin\Auth\AuthValidate;
use Illuminate\Support\Facades\Auth;
use Tinywan\Captcha\Captcha;

class AuthService
{
    public static function login(array $input): \support\Response
    {
        $data=  (new AuthValidate())->goCheck($input);
        if (checkCode($data['code'],$data['key'])){
            return error('验证码不正确');
        }
        self::doLogin($data);
        return ok();
    }
    public static function doLogin(array $data)
    {

    }
    public static function captcha(): \support\Response
    {
        try {
            $captcha=Captcha::base64();
            return json($captcha);
        } catch (\Exception $e) {
            return json(['code'=>400,'message'=>'验证码生成失败','err'=>$e->getTrace()]);
        }
    }
}