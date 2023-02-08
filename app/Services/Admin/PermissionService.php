<?php

namespace app\Services\Admin;

use app\model\Permission;
use app\Services\BaseService;
use support\Request;

class PermissionService extends BaseService
{
    public $model;
    public $form;
    public function __construct()
    {
        $this->model = new Permission();
    }
    public function setForm(Request $request): void
    {
        $data=$request->only($this->model->getFillable());

        $this->form= $data;
    }
}