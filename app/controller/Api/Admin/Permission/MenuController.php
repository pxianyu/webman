<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\MenuService;
use support\Request;
use support\Response;

class MenuController
{
    public function index(Request $request,MenuService $Service): Response
    {
        return $Service->getOrderByIdAllData();
    }
    public function store(Request $request,MenuService $Service): Response
    {
        return $Service->store($request);
    }
    public function show(Request $request,int $id,MenuService $Service): Response
    {
        return $Service->show($id);
    }
    public function update(Request $request,int $id,MenuService $Service): Response
    {
        return $Service->updateById($request,$id);
    }
    public function destroy(Request $request,int $id,MenuService $Service): Response
    {
        return $Service->destroyById($id);
    }

}
