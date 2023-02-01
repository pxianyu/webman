<?php

namespace app\middleware;



use app\Exception\Enum;
use Shopwwi\WebmanAuth\Facade\Auth;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthCheckTest implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) :Response
    {
        // 不需要登录的路由别名
        $notLoinAction=['login','captcha'];
        // 用户未登录
        if (!in_array($request->route->getName(),$notLoinAction)  && !Auth::guard('admin_api')->user(true)) {
            return error(Enum::NOT_LOGIN,401);
        }
        return $handler($request);
    }
}