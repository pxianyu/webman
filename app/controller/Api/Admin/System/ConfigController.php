<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\ConfigService;
use app\Request;
use support\Response;

class ConfigController
{
    public function index(Request $request, ConfigService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, ConfigService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request,  ConfigService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, ConfigService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request,  ConfigService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
