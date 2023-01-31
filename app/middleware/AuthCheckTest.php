<?php

namespace app\middleware;



use Shopwwi\WebmanAuth\Facade\Auth;
use support\Log;
use Webman\Http\Response;
use Webman\Http\Request;
use Webman\MiddlewareInterface;

class AuthCheckTest implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) :Response
    {

        $notLoinAction=['/auth/login','/auth/captcha'];
        // 用户未登录
        if (!in_array($request->path(),$notLoinAction)  && !Auth::guard('admin_api')->user(true)) {
            // 拦截请求，返回一个重定向响应，请求停止向洋葱芯穿越
            return error('请先登录',401);
        }
        // 请求继续向洋葱芯穿越
        return $handler($request);
    }
}