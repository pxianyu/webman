<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\RoleService;
use app\Request;
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

    public function show(Request $request, int $id, RoleService $service): Response
    {
        return $service->show($id);
    }

    public function update(Request $request, int $id, RoleService $service): Response
    {
        return $service->updateById($request, $id);
    }

    public function destroy(Request $request, int $id, RoleService $service): Response
    {
        return $service->destroyById($id);
    }
}