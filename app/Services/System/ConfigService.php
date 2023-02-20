<?php

namespace app\Services\System;


use app\Exception\BusinessException;
use app\model\Config;
use app\Services\BaseService;
use app\Validate\Admin\System\ConfigValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use support\Request;

class ConfigService extends BaseService
{
    #[Inject(Config::class)]
    protected $model;

    protected $form;

    #[Inject(ConfigValidate::class)]
    protected ConfigValidate $validate;

    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request $request): void
    {
        ['code'=>$code,'data'=>$data,'msg'=>$msg]=  $this->validate->goCheck($request->all());
        if ($code){
            throw new BusinessException($msg,$code);
        }
        $this->form= $data;
    }
}
