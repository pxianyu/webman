<?php

namespace app\controller\Api\Admin\Permission;

use app\Exception\BusinessException;
use app\Options\DataRangeOption;
use app\Request;
use app\Services\Admin\AdminService;
use Illuminate\Validation\ValidationException;
use support\Db;
use support\Redis;
use support\Response;
use Throwable;

class AdminController
{
    public function index(Request $request, AdminService $adminService): Response
    {
        return $adminService->index($request);
    }

    /**
     * @param Request $request
     * @param AdminService $adminService
     * @return Response
     * @throws ValidationException
     * @throws Throwable
     * @throws BusinessException
     */
    public function store(Request $request, AdminService $adminService): Response
    {
        return $adminService->store($request);
    }

    public function show(Request $request, AdminService $adminService): Response
    {
        $id=$request->input('id');
        return $adminService->show((int)$id);
    }

    public function update(Request $request, AdminService $adminService): Response
    {
        $id=$request->input('id');
        return $adminService->updateById($request, (int)$id);
    }

    public function destroy(Request $request, AdminService $adminService): Response
    {
        $id=$request->input('id');
        return $adminService->destroyById((int)$id);
    }


    /**
     * 切换状态
     * @param Request $request
     * @param AdminService $adminService
     * @return Response
     */
    public function enable(Request $request, AdminService $adminService): Response
    {
        $id=$request->input('id');
        return $adminService->toggleBy((int)$id);
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

    public function test(): Response
    {
       $i= Redis::incr('test');
        Db::table('tests')->insert(['name'=>'test'.$i]);
        return ok();
    }
}