<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\BannerGroupService;
use support\Request;
use support\Response;

class BannerGroupController
{
    public function index(Request $request,BannerGroupService $Service): Response
    {
        return $Service->getOrderByIdAllData();
    }
    public function store(Request $request,BannerGroupService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,BannerGroupService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,BannerGroupService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,BannerGroupService $Service): Response
    {
        return $Service->destroyById($id);
    }

}
