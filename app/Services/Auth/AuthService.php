<?php
declare(strict_types=1);
namespace app\Services\Auth;

use app\Exception\BusinessException;
use app\Exception\Enum;
use app\model\User;
use app\Request\Admin\Auth\AuthValidate;
use support\Log;
use support\Redis;
use support\Response;
use Tinywan\Captcha\Captcha;

class AuthService
{
    public static function login(array $input): \support\Response
    {
        try {
            $data=  (new AuthValidate())->goCheck($input);
            if (checkCode($data['code'],$data['key'])){
                self::checkLoginLimit($data['username']);
                return error(Enum::CAPTCHA_ERROR);
            }
            self::doLogin($data);
            return ok();
        }catch (\Exception $exception){
            return error($exception->getMessage());
        }

    }

    /**
     * @param array $data
     * @return Response
     * @throws BusinessException
     */
    public static function doLogin(array $data): Response
    {
        $user=User::getByUserName($data['username']);
        if (!$user || !password_verify($data['password'],$user['password'])){
            self::checkLoginLimit($data['username']);
            throw new BusinessException(Enum::PASSWORD_ERROR);
        }
        return ok(Enum::LOGIN_SUCCESS);
    }
    public static function captcha(): \support\Response
    {
        try {
            $captcha=Captcha::base64();
            return json($captcha);
        } catch (\Exception $e) {
            return error(Enum::CAPTCHA_CREATE_ERROR);
        }
    }

    /**
     * 检查登录频率限制
     *
     * @param string $username
     * @param int $limit
     * @return bool|Response
     * @throws \Exception
     */
    protected static function checkLoginLimit(string $username,int $limit=5): \support\Response|bool
    {
        if (Redis::exists($username)){
            Redis::incr($username);
            $count=Redis::get($username);

            if ($limit<(int)$count){
                throw new BusinessException(Enum::LOGIN_ERROR);
            }
        }else{
            Redis::incr($username);
            Redis::expire($username,300);
        }
        return true;
    }
}