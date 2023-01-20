<?php
declare(strict_types=1);
namespace app\Services\Auth;

use app\Exception\Enum;
use app\model\Admin;
use app\Request\Admin\Auth\AuthValidate;
use Exception;
use Illuminate\Support\Carbon;
use support\Log;
use support\Redis;
use support\Response;
use Tinywan\Captcha\Captcha;

class AuthService
{
    public static function login(array $input): Response
    {
        try {
            list('code'=>$code,'data'=>$data,'msg'=>$msg)=  (new AuthValidate())->goCheck($input);
            if ($code){
                return error($msg,$code);
            }
            if (config('plugin.tinywan.captcha.app.enable')){
                if (checkCode($data['code'],$data['key'])){
                    if (self::checkLoginLimit($data['username'])){
                        return error(Enum::LOGIN_COUNT_ERROR);
                    }
                    return error(Enum::CAPTCHA_ERROR);
                }
            }
         return   self::doLogin($data);
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return error(Enum::SYSTEM_ERROR);
        }

    }

    /**
     * @param array $data
     * @return Response
     */
    public static function doLogin(array $data): Response
    {
        $user=Admin::getByUserName($data['username']);
        if (!$user || !password_verify($data['password'],$user['password'])){
            if (self::checkLoginLimit($data['username'])){
                return error(Enum::LOGIN_COUNT_ERROR);
            }
            return error(Enum::PASSWORD_ERROR);
        }
        if ($user->status !=1){
            return  error(Enum::ACCOUNT_ERROR);
        }
        $user->last_login_ip=request()->getRealIp();
        $user->last_login_time=Carbon::now();
        $user->increment('login_num');
        $user->save();
        return ok(Enum::LOGIN_SUCCESS);
    }
    public static function captcha(): Response
    {
        try {
            $captcha=Captcha::base64();
            return json($captcha);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return error(Enum::CAPTCHA_CREATE_ERROR);
        }
    }

    /**
     * 检查登录频率限制
     *
     * @param string $username
     * @param int $limit
     * @return bool
     */
    protected static function checkLoginLimit(string $username,int $limit=5): bool
    {
        if (Redis::exists($username)){
            Redis::incr($username);
            $count=Redis::get($username);
            if ($limit<(int)$count){
                return true;
            }
        }else{
            Redis::incr($username);
            Redis::expire($username,300);
        }
        return false;
    }
}