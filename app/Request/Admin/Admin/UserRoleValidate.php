<?php

namespace app\Request\Admin\Admin;

use app\Request\BaseValidate;

class UserRoleValidate extends BaseValidate
{
    public function getRulesByEmpower(): array
    {
        return [
            'admin_id'  =>  'required|integer',
            'role_id'  =>  'required|integer'
        ];
    }
    public function messages(): array
    {
        return [
            'admin_id.required' => '用户id不能为空',
            'username.integer'     => '用户id必须为整数',
            'role_id.required'   => '角色id不能为空',
            'role_id.integer'   => '角色id必须为整数'
        ];
    }
}