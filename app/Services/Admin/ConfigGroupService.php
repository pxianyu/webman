<?php

namespace app\Services\Admin;

use app\Validate\Admin\Admin\ConfigGroupValidate;
use support\Request;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use app\Services\BaseService;
use app\model\ConfigGroup;
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
