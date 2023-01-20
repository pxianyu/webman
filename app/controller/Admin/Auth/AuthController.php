<?php
declare(strict_types=1);
namespace app\controller\Admin\Auth;


use app\Services\Auth\AuthService;
use support\Request;
use support\Response;


class AuthController
{
    /** 登录
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
          return AuthService::login($request->all());
    }

    /** 生成验证码
     * @return Response
     */
    public function captcha(): Response
    {
        return AuthService::captcha();
    }
}