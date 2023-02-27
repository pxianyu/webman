<?php

namespace app\controller\Api\Admin\Permission;

use app\Services\Admin\MenuService;
use app\Request;
use support\Response;

class MenuController
{
    public function index(Request $request, MenuService $Service): Response
    {
        return $Service->index($request);
    }

    public function store(Request $request, MenuService $Service): Response
    {
        return $Service->store($request);
    }

    public function show(Request $request, MenuService $Service): Response
    {
        $id=$request->input('id');
        return $Service->show((int)$id);
    }

    public function update(Request $request, MenuService $Service): Response
    {
        $id=$request->input('id');
        return $Service->updateById($request, (int)$id);
    }

    public function destroy(Request $request, MenuService $Service): Response
    {
        $id=$request->input('id');
        return $Service->destroyById((int)$id);
    }

}
