<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\AdminService;
use support\Request;
use support\Response;

class AdminController
{
    public function index(Request $request,AdminService $adminService)
    {
        return $adminService->getOrderByIdAllData();
    }
    public function store(Request $request,AdminService $adminService): Response
    {
        return $adminService->store($request);
    }
    public function show(Request $request,int $id,AdminService $adminService): Response
    {
        return $adminService->show($id);
    }
    public function update(Request $request,int $id,AdminService $adminService): Response
    {
        return $adminService->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,AdminService $adminService): Response
    {
        return $adminService->destroyById($id);
    }
    public function empower(Request $request,AdminService $adminService): Response
    {
        return $adminService->empower($request);
    }
}