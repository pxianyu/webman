<?php
declare(strict_types=1);
namespace app\Request\Admin\Auth;

use app\Request\BaseValidate;

class AuthValidate extends BaseValidate
{
    public array  $rule = [
        'username'  =>  'required|max:25',
        'password'  =>  'required',
        'key'       =>   'required',
        'code'      =>   'required',
    ];
    public array  $message  =   [
        'username.required' => '名称必须填写',
        'username.max'     => '名称最多不能超过25个字符',
        'password.required'   => '年龄必须是数字',
        'code.required'        => '验证码不能为空',
        'key.required'         =>"参数异常",
    ];
}