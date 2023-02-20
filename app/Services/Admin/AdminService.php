<?php

namespace app\Services\Admin;

use app\model\Admin;
use app\model\AdminHasRole;
use app\model\RoleHasDepartments;
use app\Services\BaseService;
use app\Validate\Admin\Admin\AdminValidate;
use app\Validate\Admin\Admin\UserRoleValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\exception\BusinessException;
use support\Request;
use support\Response;

class AdminService extends BaseService
{
    #[Inject(Admin::class)]
    protected $model;

    protected $form;

    #[Inject(AdminValidate::class)]
    protected AdminValidate $validate;

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
        if (!array_key_exists('password',$data)){
            unset($data['password']);
        }
        $data['is_root']=$data['is_root']??1;
        $data['status']=$data['status']??1;
        $this->form= $data;
    }

    /**
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function empower(Request $request): Response
    {
        ['code'=>$code,'data'=>$data,'msg'=>$msg]=  (new UserRoleValidate())->goCheck($request->all());
        if ($code){
            return error($msg,$code);
        }
        (new AdminHasRole())->addAdmin($data['admin_id'],$data['role_ids']);
        return ok();
    }

    public function index(Request $request): Response
    {
        $limit=$request->input('limit',10);
        if ($limit>100){
            $limit=100;
        }
        $username=$request->input('username');
        $nickname=$request->input('nickname');
        $status=$request->input('status');
       $data= Admin::query()
           ->when($username,function ($query) use ($username){
                $query->username($username);
            })
           ->when($nickname,function ($query) use ($nickname){
                $query->nickname($nickname);
            })
           ->when($status,function ($query) use ($status){
                $query->status($status);
            })
           ->paginate($limit)
           ->appends($request->all());
        return $this->paginate($data);
    }
}