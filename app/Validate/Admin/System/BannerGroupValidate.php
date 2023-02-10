<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;

class BannerGroupValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name'  =>  'required|string',
            'desc'  =>  'required|string',
        ];
    }
    public function getRulesUpdate(): array
    {
        return [
            'name'  =>  'required|string',
            'desc'  =>  'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => '分组名称不能为空',
            'desc.required' => '分组描述不能为空',
        ];
    }
}