<?php

namespace app\controller\Api\Admin\System;

use app\Services\Admin\ConfigGroupService;
use support\Request;
use support\Response;

class ConfigGroupController
{
    public function index(Request $request,ConfigGroupService $Service)
    {
        return $Service->getOrderByIdAllData();
    }
    public function store(Request $request,ConfigGroupService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,ConfigGroupService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,ConfigGroupService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,ConfigGroupService $Service): Response
    {
        return $Service->destroyById($id);
    }

}