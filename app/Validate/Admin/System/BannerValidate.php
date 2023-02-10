<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;

class BannerValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name'  =>  'required|string',
            'desc'  =>  'required|string',
            'group_id'  =>  'required|integer|exists:banner_groups,id',
            'image'  =>  'required|string',
            'url'  =>  'required|string',
            'sort'  =>  'required|integer',
        ];
    }

    public function getRulesByUpdate(): array
    {
        return [
            'name'  =>  'required|string',
            'desc'  =>  'required|string',
            'group_id'  =>  'required|integer|exists:banner_groups,id',
            'image'  =>  'required|string',
            'url'  =>  'required|string',
            'sort'  =>  'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名称不能为空',
            'desc.required' => '描述不能为空',
            'group_id.required' => '分组id不能为空',
            'group_id.integer' => '分组id必须为整数',
            'group_id.exists' => '分组不存在',
            'image.required' => '图片不能为空',
            'url.required' => '链接不能为空',
            'sort.required' => '排序不能为空',
            'sort.integer' => '排序必须为整数',
        ];
    }
}