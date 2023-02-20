<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\AdminService;
use Illuminate\Validation\ValidationException;
use support\Request;
use support\Response;

class AdminController
{
    public function index(Request $request,AdminService $adminService): Response
    {
        return $adminService->index($request);
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

    /**
     * @param Request $request
     * @param AdminService $adminService
     * @return Response
     * @throws ValidationException
     */
    public function empower(Request $request, AdminService $adminService): Response
    {
        return $adminService->empower($request);
    }
}