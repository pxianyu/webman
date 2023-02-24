<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;

class MenuValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name' => 'required|string',
            'pid' => 'required|integer',
            'sort' => 'sometimes|integer',
            'path' => 'required|string',
            'roles' => 'required|string',
            'redirect' => 'required|string',
            'component' => 'required',
            'title' => 'required|string',
            'isLink' => 'sometimes|in:0,1',
            'status' => 'sometimes|in:0,1',
            'isHide' => 'sometimes|in:0,1',
            'isAffix' => 'sometimes|in:0,1',
            'isKeepAlive' => 'sometimes|in:0,1',
            'isIframe' => 'sometimes|in:0,1',

        ];
    }

    public function getRulesByUpdate(): array
    {
        $id= request()->route?->param('id');
        return [
            'name' => 'required|string',
            'pid' => 'required|integer',
            'sort' => 'sometimes|integer',
            'path' => 'required|string',
            'roles' => 'required|string',
            'redirect' => 'required|string',
            'component' => 'required',
            'title' => 'required|string',
            'isLink' => 'sometimes|in:0,1',
            'status' => 'sometimes|in:0,1',
            'isHide' => 'sometimes|in:0,1',
            'isAffix' => 'sometimes|in:0,1',
            'isKeepAlive' => 'sometimes|in:0,1',
            'isIframe' => 'sometimes|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '菜单名称不能为空',
            'name.string'=>'菜单名称必须为字符串',
            'pid.required' => '父级菜单不能为空',
            'pid.integer' => '父级菜单异常',
            'sort.integer' => '排序参数异常',
            'path.required' => '菜单路径不能为空',
            'path.string' => '菜单路径必须为字符串',
            'roles.required' => '权限标识不能为空',
            'roles.string' => '权限标识必须为字符串',
            'redirect.required' => '重定向路径不能为空',
            'redirect.string' => '重定向路径必须为字符串',
            'component.required' => '组件路径不能为空',
            'title.required' => '菜单标题不能为空',
            'title.string' => '菜单标题必须为字符串',
            'isLink.in_array' => '是否外链参数异常',
            'status.in_array' => '是否显示参数异常',
            'isHide.in_array' => '是否隐藏参数异常',
            'isAffix.in_array' => '是否固定标签参数异常',
            'isKeepAlive.in_array' => '是否缓存参数异常',
            'isIframe.in_array' => '是否内嵌iframe参数异常',
        ];
    }

}