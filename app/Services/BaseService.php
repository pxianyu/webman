<?php

namespace app\Services;

use support\Request;
use support\Response;
class BaseService
{
    public $form;
    public $model;
    /** 更新状态
     * @param $request
     * @param $model
     * @return Response
     */
    public function updateStatus($request,$model): Response
    {
        $type=$request->input('type');
        if (!$type){
            return error('参数错误');
        }
        $model->$type=$model->$type?0:1;
        $model->save();
        return ok();
    }
    public function updateById(Request $request,int $id): Response
    {
        $this->setForm($request);
        $model=$this->model->find($id);
        $res=$model->update($this->form);
        if(!$res){
            return error();
        }
        return ok();
    }
    //获取排序后的所有数据
    public function getData(): Response
    {
        return successData($this->model->orderBy('id','asc')->get()->toArray());
    }


    // 获取所有数据
    public function getAll(): Response
    {
        return successData($this->model->all()->toArray());
    }

    public function setForm(Request $request): void
    {
        $this->form=$request->all();
    }
    /** 创建
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $this->setForm($request);
        $res=$this->model->create($this->form);
        if(!$res){
            return error();
        }
        return ok();
    }

    /** 详细
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return successJsonData($this->model->find($id));
    }

}