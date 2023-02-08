<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;

class MenuValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name'  =>  'required',
            'parent_id'  =>  'required|integer',
            'sort'    =>  'sometimes|required|integer',
            'icon'  =>  'required',
            'path'  =>  'required',
            'component'  =>  'required',
            'hidden'  =>  'required|in_array:0,1',
            'always_show'  =>  'required|in_array:0,1',
            'redirect'  =>  'required',
            'title'  =>  'required',
            'affix'  =>  'required|in_array:0,1',
            'breadcrumb'  =>  'required|in_array:0,1',
            'active_menu'  =>  'required',
            'is_frame'  =>  'required|in_array:0,1',
            'status'  =>  'required|in_array:0,1',
        ];
    }
    public function getRulesByUpdate(): array
    {
        $update=request()->route;
        return [
            'name'  =>  'required',
            'parent_id'  =>  'required|integer',
            'sort'    =>  'sometimes|required|integer',
            'icon'  =>  'required',
            'path'  =>  'required',
            'component'  =>  'required',
            'hidden'  =>  'required|in_array:0,1',
            'always_show'  =>  'required|in_array:0,1',
            'redirect'  =>  'required',
            'title'  =>  'required',
            'no_cache'  =>  'required|in_array:0,1',
            'affix'  =>  'required|in_array:0,1',
            'breadcrumb'  =>  'required|in_array:0,1',
            'active_menu'  =>  'required',
            'is_frame'  =>  'required|in_array:0,1',
            'status'  =>  'required|in_array:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => '菜单名称不能为空',
            'parent_id.required' => '父级id不能为空',
            'parent_id.integer' => '父级id必须为整数',
            'sort.required' => '排序不能为空',
            'sort.integer' => '排序必须为整数',
            'icon.required' => '图标不能为空',
            'path.required' => '路径不能为空',
            'component.required' => '组件不能为空',
            'hidden.required' => '是否隐藏不能为空',
            'hidden.in_array' => '是否隐藏参数异常',
            'always_show.required' => '是否一直显示不能为空',
            'always_show.in_array' => '是否一直显示参数异常',
            'redirect.required' => '重定向不能为空',
            'title.required' => '标题不能为空',
            'affix.required' => '是否固定标签不能为空',
            'affix.in_array' => '是否固定标签参数异常',
            'breadcrumb.required' => '是否面包屑不能为空',
            'breadcrumb.in_array' => '是否面包屑参数异常',
            'active_menu.required' => '激活菜单不能为空',
            'is_frame.required' => '是否外链不能为空',
            'is_frame.in_array' => '是否外链参数异常',
            'status.required' => '状态不能为空',
            'status.in_array' => '状态参数异常',
        ];
    }

}