<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class BannerValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'title' => 'required|unique:banners',
            'banner_group_id' => 'required|integer|exists:banner_groups,id',
            'pic' => 'required|string',
            'link' => 'sometimes|string',
        ];
    }

    public function getRulesByUpdate(): array
    {
        $route = request()->route;
        return [
            'title' => [
                'required',
                Rule::unique('banners')->ignore($route ? $route->param('id') : '')
            ],
            'banner_group_id' => 'required|integer|exists:banner_groups,id',
            'pic' => 'required|string',
            'link' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '名称不能为空',
            'title.unique' => '名称不能重复',
            'banner_group_id.required' => '分组id不能为空',
            'banner_group_id.integer' => '分组id必须为整数',
            'banner_group_id.exists' => '分组不存在',
            'pic.required' => '图片不能为空',
            'pic.string' => '图片不能为空',
            'link.string' => '链接不对'
        ];
    }
}