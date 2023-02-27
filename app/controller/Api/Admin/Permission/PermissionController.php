<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\PermissionService;
use app\Request;
use support\Response;

class PermissionController
{
    public function index(Request $request, PermissionService $service): Response
    {
        return $service->index($request);
    }

    public function store(Request $request, PermissionService $service): Response
    {
        return $service->store($request);
    }

    public function show(Request $request,  PermissionService $service): Response
    {
        $id=$request->input('id');
        return $service->show((int)$id);
    }

    public function update(Request $request, PermissionService $service): Response
    {
        $id=$request->input('id');
        return $service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, PermissionService $service): Response
    {
        $id=$request->input('id');
        return $service->destroyById((int)$id);
    }
}