<?php

namespace app\controller\Api\Admin\Permission;

use support\Request;
use support\Response;
use app\Services\System\JobService;
class JobController
{
    public function index(Request $request,JobService $Service): Response
    {
        return $Service->index($request);
    }
    public function store(Request $request,JobService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,JobService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,JobService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,JobService $Service): Response
    {
        return $Service->destroyById($id);
    }

}
