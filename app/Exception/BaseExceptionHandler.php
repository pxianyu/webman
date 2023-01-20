<?php

namespace app\Exception;

use Illuminate\Validation\ValidationException;
use support\exception\Handler;
use Webman\Http\Request;
use Webman\Http\Response;
use Throwable;
class BaseExceptionHandler extends  Handler
{
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render(Request $request, Throwable $exception) : Response
    {
        // 数据验证异常
        if ($exception instanceof ValidationException) {
            return json(['message' => $exception->getMessage(), 'code' => 50015]);
        }

        // 业务异常
        if ($exception instanceof BusinessException) {
            return json(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
        return json(['message' => Enum::SYSTEM_ERROR, 'code' => 500]);
    }
}