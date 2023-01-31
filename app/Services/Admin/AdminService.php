<?php

namespace app\Services\Admin;

use app\model\Admin;
use app\Services\BaseService;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;

class AdminService extends BaseService
{
    public $model;
    public $form;
    public function __construct()
    {
        $this->model = new Admin();
    }
    public function setForm(Request $request): void
    {
        $data=[
            'username'=>$request->input('username') ,
            'password'=>Auth::bcrypt($request->input('password')??''),
            'status'=>$request->input('status')??1,
            'nickname'=>$request->input('nickname'),
            'is_root'=>$request->input('is_root')??1
        ];

        if ($request->input('password','') == '') {
            unset($data['password']);
        }
        $this->form= $data;
    }
}