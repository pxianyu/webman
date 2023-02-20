<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class ConfigValidate extends BaseValidate
{
    public function getRulesStore(): array
    {
        return [
            'name'  => 'required|unique:configs',
            'value'  =>  'required|string',
            'type'  =>  'required|integer',
            'group'  =>  'required|string',
            'remark'  =>  'required|string',
            'sort'  =>  'required|integer',
            'status'  =>  'required|integer',
        ];
    }
    public function getRulesUpdate(): array
    {
        $route=request()->route;
        return [
            'name'  =>  [
                'required',
                Rule::unique('configs')->ignore($route?$route->param('id'):'')
            ],
            'value'  =>  'required|string',
            'type'  =>  'required|integer',
            'group'  =>  'required|string',
            'remark'  =>  'required|string',
            'sort'  =>  'required|integer',
            'status'  =>  'required|integer',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => '配置名称不能为空',
            'name.unique' => '配置名称不能重复',
            'name.string' => '配置名称必须为字符串',
            'value.required' => '配置值不能为空',
            'value.string' => '配置值必须为字符串',
            'type.required' => '配置类型不能为空',
            'type.integer' => '配置类型必须为整数',
            'group.required' => '配置分组不能为空',
            'group.string' => '配置分组必须为字符串',
            'remark.required' => '配置备注不能为空',
            'remark.string' => '配置备注必须为字符串',
            'sort.required' => '排序不能为空',
            'sort.integer' => '排序必须为整数',
            'status.required' => '状态不能为空',
            'status.integer' => '状态必须为整数',
        ];
    }
}