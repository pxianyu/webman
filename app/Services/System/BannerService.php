<?php

namespace app\Services\System;

use app\Exception\BusinessException;
use app\model\Banner;
use app\Services\BaseService;
use app\Validate\Admin\System\BannerValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use support\Request;
use support\Response;

class BannerService extends BaseService
{
    #[Inject(Banner::class)]
    protected $model;

    protected $form;

    #[Inject(BannerValidate::class)]
    protected BannerValidate $validate;

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
