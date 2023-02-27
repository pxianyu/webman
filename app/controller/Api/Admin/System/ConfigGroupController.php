<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\ConfigGroupService;
use app\Request;
use support\Response;

class ConfigGroupController
{
    /**
     * @param Request $request
     * @param ConfigGroupService $Service
     * @return Response
     */
    public function index(Request $request, ConfigGroupService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, ConfigGroupService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request,  ConfigGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, ConfigGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, ConfigGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
