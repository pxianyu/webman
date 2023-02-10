<?php

namespace app\Services\System;

use app\Exception\BusinessException;
use app\model\BannerGroup;
use app\Services\BaseService;
use app\Validate\Admin\System\BannerGroupValidate;
use Illuminate\Validation\ValidationException;
use support\Request;

class BannerGroupService extends BaseService
{
    public $model;
    public $form;
    public BannerGroupValidate $validate;
    public function __construct()
    {
        $this->model = new BannerGroup();
        $this->validate= new BannerGroupValidate();
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