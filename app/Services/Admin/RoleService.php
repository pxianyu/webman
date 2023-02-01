<?php

namespace app\Services\Admin;

use app\model\Role;
use app\Services\BaseService;
use support\Request;

class RoleService extends BaseService
{
    public $model;
    public $form;
    public function __construct()
    {
        $this->model = new Role();
    }
    public function setForm(Request $request): void
    {
        $data=[
            'name'=>$request->input('name') ,
            'desc'=>$request->input('desc'),
        ];

        $this->form= $data;
    }
}