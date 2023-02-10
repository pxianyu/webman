<?php

namespace app\Services\System;

use app\Exception\BusinessException;
use app\model\ConfigGroup;
use app\Services\BaseService;
use app\Validate\Admin\System\ConfigGroupValidate;
use Illuminate\Validation\ValidationException;
use support\Request;

class ConfigGroupService extends BaseService
{
    public $model;
    public $form;
    public ConfigGroupValidate $validate;
    public function __construct()
    {
        $this->model = new ConfigGroup();
        $this->validate=new ConfigGroupValidate();
    }
    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request $request): void
    {
        list('code'=>$code,'data'=>$data,'msg'=>$msg)=  $this->validate->goCheck($request->all());
        if ($code){
            throw new BusinessException($msg,$code);
        }
        $this->form= $data;
    }
}
