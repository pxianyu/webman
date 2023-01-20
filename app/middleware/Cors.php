<?php

namespace app\middleware;

use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class Cors implements  MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $response = $request->method() == 'OPTIONS' ? response('') : $next($request);
        $response->withHeaders([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Headers' => 'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With,Origin',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
        ]);
        return $response;
    }
}