<?php

namespace app\Services\Admin;

use app\Validate\Admin\Admin\BannerValidate;
use support\Request;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use app\Services\BaseService;
use app\model\Banner;
class BannerService extends BaseService
{
    public $model;
    public $form;
    public BannerValidate $validate;
    public function __construct()
    {
        $this->model = new Banner();
        $this->validate= new BannerValidate();
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
