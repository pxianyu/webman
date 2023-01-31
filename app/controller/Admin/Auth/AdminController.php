<?php

namespace app\controller\Admin\Auth;

use app\Services\Admin\AdminService;
use support\Request;
use support\Response;

class AdminController
{
    public function index(Request $request,AdminService $adminService)
    {
        return $adminService->getData();
    }
    public function create(Request $request,AdminService $adminService): Response
    {
        return $adminService->store($request);
    }
    public function show(Request $request,$id,AdminService $adminService): Response
    {
        return $adminService->show($id);
    }
}