<?php

namespace app\controller\Api\Admin\Permission;

use app\Exception\BusinessException;
use app\Services\Admin\RoleService;
use app\Request;
use Illuminate\Validation\ValidationException;
use support\Response;

class RoleController
{
    public function index(Request $request, RoleService $service): Response
    {
        return $service->index($request);
    }

    public function store(Request $request, RoleService $service): Response
    {
        return $service->store($request);
    }

    /**
     * 添加角色相关权限
     * @param Request $request
     * @param int $id
     * @param RoleService $service
     * @return Response
     */
    public function show(Request $request, int $id, RoleService $service): Response
    {
        return $service->show($id);
    }

    /**
     * 更新角色相关权限
     * @param Request $request
     * @param int $id
     * @param RoleService $service
     * @return Response
     * @throws ValidationException
     * @throws BusinessException
     */
    public function update(Request $request, int $id, RoleService $service): Response
    {
        return $service->updateById($request, $id);
    }

    public function destroy(Request $request, int $id, RoleService $service): Response
    {
        return $service->destroyById($id);
    }
}