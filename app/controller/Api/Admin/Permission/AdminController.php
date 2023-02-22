<?php

namespace app\controller\Api\Admin\Permission;

use app\Options\DataRangeOption;
use app\Request;
use app\Services\Admin\AdminService;
use Illuminate\Validation\ValidationException;
use support\Response;

class AdminController
{
    public function index(Request $request, AdminService $adminService): Response
    {
        return $adminService->index($request);
    }

    public function store(Request $request, AdminService $adminService): Response
    {
        return $adminService->store($request);
    }

    public function show(Request $request, int $id, AdminService $adminService): Response
    {
        return $adminService->show($id);
    }

    public function update(Request $request, int $id, AdminService $adminService): Response
    {
        return $adminService->updateById($request, $id);
    }

    public function destroy(Request $request, int $id, AdminService $adminService): Response
    {
        return $adminService->destroyById($id);
    }

    /**
     * 授权
     * @param Request $request
     * @param AdminService $adminService
     * @return Response
     * @throws ValidationException
     */
    public function empower(Request $request, AdminService $adminService): Response
    {
        return $adminService->empower($request);
    }

    /**
     * 切换状态
     * @param Request $request
     * @param int $id
     * @param AdminService $adminService
     * @return Response
     */
    public function enable(Request $request, int $id, AdminService $adminService): Response
    {
        return $adminService->toggleBy($id);
    }

    /** 获取数据范围
     * @param Request $request
     * @param DataRangeOption $dataRangeOption
     * @return Response
     */
    public function dataRange(Request $request, DataRangeOption $dataRangeOption): Response
    {
        return successData($dataRangeOption->get());
    }
}