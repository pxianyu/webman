<?php

namespace app\Services\System;
use app\Services\BaseService;
use app\Request;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use DI\Attribute\Inject;
use app\model\Department;

class DepartmentService extends BaseService
{
    #[Inject(Department::class)]
    protected $model;
    protected $form;
    protected $validate;

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
