<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class ConfigValidate extends BaseValidate
{
    public function getRulesStore(): array
    {
        return [
            'name' => 'required|unique:configs',
            'value' => 'required|string',
            'type' => 'sometimes|integer',
            'config_group_id' => 'required|integer|exists:config_groups,id',
            'remark' => 'sometimes|string',
            'sort' => 'sometimes|integer',
            'status' => 'sometimes|integer',
        ];
    }

    public function getRulesUpdate(): array
    {
        $id= request()->route?->param('id');
        return [
            'name' => [
                'required',
                Rule::unique('configs')->ignore($id)
            ],
            'value' => 'required|string',
            'type' => 'sometimes|integer',
            'config_group_id' => 'required|integer|exists:config_groups,id',
            'remark' => 'sometimes|string',
            'sort' => 'sometimes|integer',
            'status' => 'sometimes|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名称不能为空',
            'name.unique' => '名称不能重复',
            'name.string' => '名称必须为字符串',
            'value.required' => '配置值不能为空',
            'value.string' => '配置值必须为字符串',
            'type.integer' => '配置类型必须为整数',
            'config_group_id.required' => '配置分组不能为空',
            'config_group_id.exists' => '分组不存在',
            'config_group_id.string' => '配置分组必须为字符串',
            'remark.string' => '备注必须为字符串',
            'sort.integer' => '排序必须为整数',
            'status.integer' => '状态必须为整数',
        ];
    }
}