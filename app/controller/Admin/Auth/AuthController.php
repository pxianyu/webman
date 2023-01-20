<?php
declare(strict_types=1);
namespace app\controller\Admin\Auth;


use app\Services\Auth\AuthService;
use support\Request;


class AuthController
{
    /** 登录
     * @param Request $request
     * @return \support\Response
     */
    public function index(Request $request): \support\Response
    {
          return AuthService::login($request->all());
    }

    /** 生成验证码
     * @param Request $request
     * @return \support\Response
     */
    public function captcha(Request $request): \support\Response
    {
        return AuthService::captcha();
    }
}