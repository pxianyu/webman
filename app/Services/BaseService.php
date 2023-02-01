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
    public function updateStatus(Request $request,int $id): Response
    {
        $type=$request->input('type');
        if (!$type || !is_integer($type)){
            return error('参数错误');
        }
        $model=$this->model->find($id);
        $model->$type=$model->$type?0:1;
        $model->save();
        return ok();
    }

    /** 根据id更新数据
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateById(Request $request,int $id): Response
    {
        $this->setForm($request);
        $model=$this->model->findorfail($id);
        $res=$model->update($this->form);
        if($res===false){
            return error();
        }
        return ok();
    }

    /** 根据id删除数据
     * @param int $id
     * @return Response
     */
    public function destroyById(int $id): Response
    {
        $res=$this->model->destroy($id);
        if($res===false){
            return error();
        }
        return ok();
    }

    /** 获取id排序所有数据
     * @return Response
     */
    public function getOrderByIdAllData(): Response
    {
        return successData($this->model->orderBy('id','asc')->get()->toArray());
    }


    /** 获取所有数据
     * @return Response
     */
    public function getAll(): Response
    {
        return successData($this->model->all()->toArray());
    }

    /** 设置表单字段
     * @param Request $request
     * @return void
     */
    public function setForm(Request $request): void
    {
        $this->form=$request->all();
    }
    /** 新增数据
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

    /** 详细详细
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return successJsonData($this->model->findorfail($id));
    }

}