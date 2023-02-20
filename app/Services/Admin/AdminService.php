<?php

namespace app\Services\Admin;

use app\model\Admin;
use app\model\UserRoles;
use app\Validate\Admin\Admin\AdminValidate;
use app\Validate\Admin\Admin\UserRoleValidate;
use app\Services\BaseService;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Request;
use support\Response;
use support\exception\BusinessException;
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
        if (array_key_exists('password',$data)){
            $data['password']=Auth::bcrypt($data['password']);
        }else{
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
        (new UserRoles())->addAdmin($data['admin_id'],$data['role_ids']);
        return ok();
    }
}