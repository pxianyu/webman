<?php

namespace app\Validate\Admin\Admin;

use app\Validate\BaseValidate;

class MenuValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name' => 'required',
            'parent_id' => 'required|integer',
            'sort' => 'sometimes|required|integer',
            'path' => 'required',
            'component' => 'required',
            'title' => 'required',
            'affix' => 'sometimes|in_array:0,1',
            'is_frame' => 'sometimes|in_array:0,1',
            'status' => 'sometimes|in_array:0,1'
        ];
    }

    public function getRulesByUpdate(): array
    {
        $update = request()->route;
        return [
            'name' => 'required',
            'parent_id' => 'required|integer',
            'sort' => 'sometimes|required|integer',
            'path' => 'required',
            'component' => 'required',
            'title' => 'required',
            'affix' => 'sometimes|in_array:0,1',
            'is_frame' => 'sometimes|in_array:0,1',
            'status' => 'sometimes|in_array:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '菜单名称不能为空',
            'parent_id.required' => '父级id不能为空',
            'parent_id.integer' => '父级id必须为整数',
            'sort.integer' => '排序必须为整数',
            'path.required' => '路径不能为空',
            'component.required' => '组件不能为空',
            'hidden.in_array' => '是否隐藏参数异常',
            'title.required' => '标题不能为空',
            'affix.in_array' => '是否固定标签参数异常',
            'is_frame.in_array' => '是否外链参数异常',
            'status.in_array' => '状态参数异常',
        ];
    }

}