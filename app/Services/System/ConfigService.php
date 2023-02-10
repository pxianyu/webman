<?php

namespace app\Services\System;


use app\Exception\BusinessException;
use app\model\Config;
use app\Services\BaseService;
use app\Validate\Admin\System\ConfigValidate;
use Illuminate\Validation\ValidationException;
use support\Request;

class ConfigService extends BaseService
{
    public $model;
    public $form;
    public ConfigValidate $validate;
    public function __construct()
    {
        $this->model = new Config();
        $this->validate=new ConfigValidate();
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
