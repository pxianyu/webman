<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\BannerGroupService;
use app\Request;
use support\Response;

class BannerGroupController
{
    public function index(Request $request, BannerGroupService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, BannerGroupService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request, BannerGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, BannerGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, BannerGroupService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
