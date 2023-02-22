<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\PermissionService;
use app\Request;
use support\Response;

class PermissionController
{
    public function index(Request $request,PermissionService $service): Response
    {
        return $service->getOrderByIdAllData();
    }
    public function store(Request $request,PermissionService $service): Response
    {
        return $service->store($request);
    }
    public function show(Request $request,int $id,PermissionService $service): Response
    {
        return $service->show($id);
    }
    public function update(Request $request,int $id,PermissionService $service): Response
    {
        return $service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,PermissionService $service): Response
    {
        return $service->destroyById($id);
    }
}