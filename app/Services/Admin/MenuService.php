<?php

namespace app\Services\Admin;

use app\Common\ArrUtil;
use app\Validate\Admin\Admin\MenuValidate;
use DI\Attribute\Inject;
use app\Request;
use Illuminate\Validation\ValidationException;
use support\exception\BusinessException;
use app\Services\BaseService;
use app\model\Menu;
use support\Response;

class MenuService extends BaseService
{
    #[Inject(Menu::class)]
    protected $model;

    protected $form;

    #[Inject(MenuValidate::class)]
    protected MenuValidate $validate;

    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request $request): void
    {
        ['code' => $code, 'data' => $data, 'msg' => $msg] = $this->validate->goCheck($request->all());
        if ($code) {
            throw new BusinessException($msg, $code);
        }
        $this->form = $data;
    }
    public function index(Request $request): Response
    {
        return successData(ArrUtil::menus($this->model->all($this->model->getFields())->toArray(),$this->model->getKeyName(), $this->model->getParentIdColumn()));
    }
}
