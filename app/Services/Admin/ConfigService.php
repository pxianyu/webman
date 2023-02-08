<?php

namespace app\Services\Admin;

use app\Validate\Admin\Admin\ConfigValidate;
use support\Request;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use app\Services\BaseService;
use app\model\Config;
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
