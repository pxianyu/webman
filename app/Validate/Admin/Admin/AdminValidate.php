<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class AdminValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'username' => 'required|alpha_dash|unique:admins',
            'password' => 'required',
            'status' => 'sometimes|required|in_array:0,1',
            'nickname' => 'required'
        ];
    }

    public function getRulesByUpdate(): array
    {
        $route = request()->route;
        return [
            'username' => [
                'required',
                'alpha_dash',
                Rule::unique('admins')->ignore($route ? $route->param('id') : '')
            ],
            'status' => 'sometimes|required|in_array:0,1',
            'nickname' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => '账号不能为空',
            'username.unique' => '账号不能重复',
            'username.alpha_dash' => '账号只能包含字母、数字，短破折号（-）和下划线（_）',
            'nickname.required' => '昵称不能为空',
            'password.required' => '密码不能为空',
            'status.required' => '状态参数不能为空',
            'status.in_array' => '状态参数异常',
        ];
    }
}