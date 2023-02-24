<?php

namespace app\Services\Admin;

use app\Exception\BusinessException;
use app\model\Admin;
use app\Request;
use app\Services\BaseService;
use app\Validate\Admin\Admin\AdminValidate;
use DI\Attribute\Inject;
use Illuminate\Validation\ValidationException;
use support\Db;
use support\Response;
use Throwable;

class AdminService extends BaseService
{
    #[Inject(Admin::class)]
    protected $model;

    protected $form;

    #[Inject(AdminValidate::class)]
    protected AdminValidate $validate;

    /**
     * @throws ValidationException|BusinessException
     */
    public function setForm(Request $request): void
    {
        ['code' => $code, 'data' => $data, 'msg' => $msg] = $this->validate->goCheck($request->all());
        if ($code) {
            throw new BusinessException($msg, $code);
        }
        if (!array_key_exists('password', $data) || empty($data['password'])) {
            unset($data['password']);
        }
        $data['is_root'] = $data['is_root'] ?? 0;
        $data['status'] = $data['status'] ?? 1;
        $this->form = $data;
    }


    /**
     * @throws ValidationException
     * @throws BusinessException|Throwable
     */
    public function store(Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->setForm($request);
            $admin=$this->model->create($this->form);
            $admin->roles()->attach($this->form['role_id']);
            Db::commit();
        }catch (Throwable $e){
            Db::rollBack();
            throw $e;
        }
        return ok();
    }

    public function index(Request $request): Response
    {
        $limit = $request->input('limit', 10);
        if ($limit > 100) {
            $limit = 100;
        }
        $username = $request->input('username');
        $nickname = $request->input('nickname');
        $status = $request->input('status');
        return successData($this->model->getPaginateData($username, $nickname, $status, $limit)->toArray());
    }
}