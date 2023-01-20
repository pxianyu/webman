<?php
declare(strict_types=1);
namespace app\Request\Admin\Auth;

use app\Request\BaseValidate;

class AuthValidate extends BaseValidate
{
    public function rules(): array
    {
        $rule=[
            'username'  =>  'required|max:25',
            'password'  =>  'required'
        ];
        if (config('plugin.tinywan.captcha.app.enable')){
            $rule=array_merge($rule,['key'=>'required','code'=>'required']);
        }
        return $rule;
    }
    public function messages(): array
    {
        $message=[
            'username.required' => '用户名必须填写',
            'username.max'     => '用户名最多不能超过25个字符',
            'password.required'   => '密码必须是数字'
        ];
        if (config('plugin.tinywan.captcha.app.enable')){
            $message=array_merge($message,['code.required'=>'验证码不能为空','key.required'=>'key不能为空']);
        }
        return $message;
    }
}