<?php

namespace app\Services\Admin;

use app\model\Permission;
use app\Services\BaseService;
use DI\Attribute\Inject;
use support\Request;

class PermissionService extends BaseService
{
    #[Inject(Permission::class)]
    protected $model;

    protected $form;

    public function setForm(Request $request): void
    {
        $data=$request->only($this->model->getFillable());

        $this->form= $data;
    }
}