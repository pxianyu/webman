<?php

namespace app\controller\Api\Admin\Permission;

use support\Request;
use support\Response;
use app\Services\System\DepartmentService;
class DepartmentController
{
    public function index(Request $request,DepartmentService $Service): Response
    {
        return $Service->index($request);
    }
    public function store(Request $request,DepartmentService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,DepartmentService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,DepartmentService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,DepartmentService $Service): Response
    {
        return $Service->destroyById($id);
    }

}
