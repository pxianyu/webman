<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;

class UserRoleValidate extends BaseValidate
{
    public function getRulesByEmpower(): array
    {
        return [
            'admin_id'  =>  'required|integer|exists:admins,id',
            'role_id'  =>  'required|integer|exists:roles,id'
        ];
    }
    public function messages(): array
    {
        return [
            'admin_id.required' => '用户id不能为空',
            'username.integer'     => '用户id必须为整数',
            'role_id.required'   => '角色id不能为空',
            'role_id.integer'   => '角色id必须为整数',
            'role_id.exists'   => '角色不存在',
            'admin_id.exists'   => '要授权的用户不存在',
        ];
    }
}