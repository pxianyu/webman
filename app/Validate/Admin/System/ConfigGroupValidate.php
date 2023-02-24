<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class ConfigGroupValidate extends BaseValidate
{
    public function getRulesStore(): array
    {
        return [
            'name' => 'required|unique:config_groups',
            'sort' => 'sometimes|integer',
        ];
    }

    public function getRulesUpdate(): array
    {
        $id= request()->route?->param('id');
        return [
            'name' => [
                'required',
                Rule::unique('config_groups')->ignore($id)
            ],
            'sort' => 'sometimes|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '配置分组名称不能为空',
            'name.unique' => '配置分组名称不能重复',
            'name.string' => '配置分组名称必须为字符串',
            'sort.integer' => '排序必须为整数',
        ];
    }
}