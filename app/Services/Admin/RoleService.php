<?php

namespace app\Services\Admin;

use app\model\Role;
use app\Services\BaseService;
use DI\Attribute\Inject;
use app\Request;

class RoleService extends BaseService
{
    #[Inject(Role::class)]
    protected $model;

    protected $form;

    public function setForm(Request $request): void
    {
        $data=[
            'name'=>$request->input('name') ,
            'desc'=>$request->input('desc'),
            'data_range'=>$request->input('data_range') ?? 0,
        ];

        $this->form= $data;
    }
}