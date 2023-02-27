<?php

namespace app\controller\Api\Admin\Permission;

use app\Request;
use support\Response;
use app\Services\System\DepartmentService;

class DepartmentController
{
    public function index(Request $request, DepartmentService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, DepartmentService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request, DepartmentService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, DepartmentService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, DepartmentService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
