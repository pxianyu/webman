<?php

namespace app\Services\Admin;

use app\Exception\BusinessException;
use app\model\Department;
use app\model\Role;
use app\Request;
use app\Services\BaseService;
use app\Validate\Admin\Admin\RoleValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use support\Db;
use support\Response;
use Throwable;

class RoleService extends BaseService
{
    #[Inject(Role::class)]
    protected $model;

    protected $form;

    #[Inject(RoleValidate::class)]
    protected RoleValidate $validate;

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

    /**
     * @throws ValidationException
     * @throws BusinessException
     * @throws Throwable
     */
    public function store(Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->setForm($request);
            $role = $this->model->create($this->form);
            $role->permissions()->attach($this->form['permission_ids']);
            if (!empty($this->form['department_ids'])){
                $role->departments()->attach(Department::whereIn('id',$this->form['department_ids'])->get());
            }
            $role->menus()->attach($this->form['menu_ids']);
            Db::commit();
        }catch (Throwable $exception){
            Db::rollBack();
            throw $exception;
        }

        return ok();
    }

    /**
     * 更新角色
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws BusinessException
     * @throws ValidationException
     * @throws Throwable
     */
    public function updateById(Request $request, int $id): Response
    {
        Db::beginTransaction();
        try {
            $this->setForm($request);
            $role = $this->model->findorfail($id);
            $role->update($this->form);
            $role->permissions()->sync($this->form['permission_ids']);
            if (!empty($this->form['department_ids'])){
                $role->departments()->sync(Department::whereIn('id',$this->form['department_ids'])->get());
            }
            $role->menus()->sync($this->form['menu_ids']);
            Db::commit();
        }catch (Throwable $exception){
            Db::rollBack();
            throw $exception;
        }
        return ok();
    }
}