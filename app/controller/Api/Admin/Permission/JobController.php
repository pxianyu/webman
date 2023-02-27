<?php

namespace app\controller\Api\Admin\Permission;

use app\Request;
use support\Response;
use app\Services\System\JobService;

class JobController
{
    public function index(Request $request, JobService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, JobService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request, JobService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, JobService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, JobService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
