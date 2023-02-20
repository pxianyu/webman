<?php

namespace app\middleware;



use app\Enum\Message;
use Shopwwi\WebmanAuth\Facade\Auth;
use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class AuthCheckTest implements MiddlewareInterface
{
    public function process(Request $request, callable $handler) :Response
    {
        // 不需要登录的路由别名
        $notLoinAction=['admin.login','admin.captcha'];
        $route=$request->route;
        // 用户未登录
        if ($route && !in_array($request->route->getName(), $notLoinAction, true) && !Auth::guard('admin_api')->user(true)) {
            return error(Message::NOT_LOGIN,401);
        }
        return $handler($request);
    }
}