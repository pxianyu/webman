<?php

namespace app\controller\Api\Admin\Auth;


use app\Services\Auth\AuthService;
use Illuminate\Validation\ValidationException;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;
use support\Response;


class AuthController
{
    /** 登录
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function login(Request $request): Response
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

    /** 退出登录
     * @return Response
     */
    public function logout(): Response
    {
        Auth::guard('admin_api')->logout();
        return ok();
    }

    /** 个人信息
     * @return Response
     */
    public function me(): Response
    {
        return successJsonData(Auth::guard('admin_api')->user());
    }
}