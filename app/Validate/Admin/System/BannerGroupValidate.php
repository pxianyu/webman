<?php

namespace app\Validate\Admin\System;

use app\Validate\BaseValidate;
use Illuminate\Validation\Rule;

class BannerGroupValidate extends BaseValidate
{
    public function getRulesByStore(): array
    {
        return [
            'name' => 'required|unique:banner_groups',
        ];
    }

    public function getRulesUpdate(): array
    {
        $id= request()->route?->param('id');
        return [
            'name' => [
                'required',
                Rule::unique('banner_groups')->ignore($id)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '分组名称不能为空',
            'name.unique' => '分组名称不能重复',
        ];
    }
}