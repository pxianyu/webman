<?php

namespace app\controller\Api\Admin\System;

use app\Services\System\BannerService;
use support\Request;
use support\Response;

class BannerController
{
    public function index(Request $request,BannerService $Service)
    {
        return $Service->getOrderByIdAllData();
    }
    public function store(Request $request,BannerService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,BannerService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,BannerService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,BannerService $Service): Response
    {
        return $Service->destroyById($id);
    }

}