<?php

namespace app\Services\Admin;

use app\model\Admin;
use app\model\UserRoles;
use app\Request\Admin\Admin\UserRoleValidate;
use app\Services\BaseService;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;
use support\Response;

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
            'is_root'=>$request->input('is_root')??1
        ];
        if ($request->input('nickname','')) {
           $data['nickname']= $request->input('nickname');
        }
        if ($request->input('password','') == '') {
            unset($data['password']);
        }
        $this->form= $data;
    }
    public function empower(Request $request): Response
    {
        list('code'=>$code,'data'=>$data,'msg'=>$msg)=  (new UserRoleValidate())->goCheck($request->all());
        if ($code){
            return error($msg,$code);
        }
        UserRoles::create([
            'admin_id' => $data['admin_id'],
            'role_id' => $data['role_id']
        ]);
        return ok();
    }
}