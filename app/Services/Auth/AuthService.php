<?php
declare(strict_types=1);
namespace app\Services\Auth;

use app\Exception\Enum;
use app\model\Admin;
use app\Services\BaseService;
use app\Validate\Admin\Auth\AuthValidate;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Log;
use support\Redis;
use support\Response;
use Tinywan\Captcha\Captcha;


class AuthService extends BaseService
{
    /**
     * 登录
     * @param array $input
     * @return Response
     * @throws ValidationException
     */
    public static function login(array $input): Response
    {['code'=>$code,'data'=>$data,'msg'=>$msg]=  (new AuthValidate())->goCheck($input);
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
        $tokenObject=Auth::guard('admin_api')->login( $user);
        return successJsonData($tokenObject,Enum::LOGIN_SUCCESS);
    }

    /**
     * 验证码
     * @return Response
     */
    public static function captcha(): Response
    {
        try {
            if (config('plugin.tinywan.captcha.app.enable')){
                $captcha=Captcha::base64();
                return successData($captcha);
            }else{
                return error('验证码功能没有打开',423);
            }

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