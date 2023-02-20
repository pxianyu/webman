<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\ConfigService;
use support\Request;
use support\Response;

class ConfigController
{
    public function index(Request $request,ConfigService $Service): Response
    {
        return $Service->index($request);
    }
    public function store(Request $request,ConfigService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,ConfigService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,ConfigService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,ConfigService $Service): Response
    {
        return $Service->destroyById($id);
    }

}
