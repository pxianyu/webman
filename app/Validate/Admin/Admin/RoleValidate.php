<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class RoleValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name' => 'required|string|unique:roles',
            'data_range' => 'required|in:1,1,2,3,4,5',
            'permission_ids'=>'required|array|exists:permissions,id',
            'department_ids'=>'sometimes|array|exists:departments,id',
            'menu_ids'=>'required|array|exists:menus,id',
        ];
    }
    public function getRulesByUpdate(): array
    {
        $id= request()->route?->param('id');
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('roles')->ignore($id)
            ],
            'data_range' => 'required|in:1,1,2,3,4,5',
            'permission_ids'=>'required|array|exists:permissions,id',
            'department_ids'=>'sometimes|array|exists:departments,id',
            'menu_ids'=>'required|array|exists:menus,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => '角色名称不能为空',
            'name.string'=>'角色名称必须为字符串',
            'data_range.required' => '数据范围不能为空',
            'data_range.integer' => '数据范围异常',
            'permission_ids.required' => '权限不能为空',
            'permission_ids.array' => '权限参数异常',
            'department_ids.array'=>'数据权限参数异常',
            'menu_ids.required'=>'菜单权限不能为空',
            'menu_ids.array'=>'菜单权限参数异常',
            'permission_ids.exists'=>'权限不存在',
            'department_ids.exists'=>'权限范围不存',
            'menu_ids.exists'=>'菜单不存在'
        ];
    }
}