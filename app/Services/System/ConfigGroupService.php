<?php

namespace app\Services\System;

use app\Exception\BusinessException;
use app\model\ConfigGroup;
use app\Services\BaseService;
use app\Validate\Admin\System\ConfigGroupValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use app\Request;

class ConfigGroupService extends BaseService
{
    #[Inject(ConfigGroup::class)]
    protected $model;

    protected $form;

    #[Inject(ConfigGroupValidate::class)]
    protected ConfigGroupValidate $validate;

    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request $request): void
    {
        ['code' => $code, 'data' => $data, 'msg' => $msg] = $this->validate->goCheck($request->all());
        if ($code) {
            throw new BusinessException($msg, $code);
        }
        $this->form = $data;
    }
}
