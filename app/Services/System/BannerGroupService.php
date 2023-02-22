<?php

namespace app\Services\System;

use app\Exception\BusinessException;
use app\model\BannerGroup;
use app\Services\BaseService;
use app\Validate\Admin\System\BannerGroupValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use app\Request;

class BannerGroupService extends BaseService
{
    #[Inject(BannerGroup::class)]
    protected $model;

    protected $form;

    #[Inject(BannerGroupValidate::class)]
    protected BannerGroupValidate $validate;
    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request $request): void
    {
        ['code' => $code, 'data' => $data, 'msg' => $msg] = $this->validate->goCheck($request->all());
        if ($code){
            throw new BusinessException($msg,$code);
        }
        $this->form= $data;
    }
}
