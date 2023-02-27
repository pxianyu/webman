<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\BannerService;
use app\Request;
use support\Response;

class BannerController
{
    public function index(Request $request, BannerService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, BannerService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request, BannerService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, BannerService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, BannerService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
