<?php

namespace app\controller\Api\Admin\Permission;

use app\Exception\BusinessException;
use app\Services\Admin\RoleService;
use app\Request;
use Illuminate\Validation\ValidationException;
use support\Response;
use Throwable;

class RoleController
{
    public function index(Request $request, RoleService $service): Response
    {
        return $service->index($request);
    }

    /**
     * @param Request $request
     * @param RoleService $service
     * @return Response
     * @throws BusinessException
     * @throws ValidationException
     * @throws Throwable
     */
    public function store(Request $request, RoleService $service): Response
    {
        return $service->store($request);
    }

    /**
     * 添加角色相关权限
     * @param Request $request
     * @param RoleService $service
     * @return Response
     */
    public function show(Request $request, RoleService $service): Response
    {
        $id=$request->input('id');
        return $service->show((int)$id);
    }

    /**
     * 更新角色相关权限
     * @param Request $request
     * @param RoleService $service
     * @return Response
     * @throws BusinessException
     * @throws Throwable
     * @throws ValidationException
     */
    public function update(Request $request, RoleService $service): Response
    {
        $id=$request->input('id');
        return $service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, RoleService $service): Response
    {
        $id=$request->input('id');
        return $service->destroyById((int)$id);
    }
}