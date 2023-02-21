<?php

namespace app\Services;

use app\Enum\StatusEnum;
use support\Request;
use support\Response;
class BaseService
{
    protected $form;
    protected $model;

    /** 更新状态
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function toggleBy(int $id, string $field = 'status'): Response
    {
        $model=$this->model->findorfail($id);
        $model->$field=$model->$field===StatusEnum::Enable->value()?StatusEnum::Disable->value():StatusEnum::Enable->value();
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
        if ($this->model->where($this->model->getParentIdColumn(),$id)->exists()) {
            return error('无法进行删除，请先删除子级');
        }
        if ($this->model->dataRange) {
            $this->model->where($this->model->getKeyName(),$id)->datarange()->delete();
        }else{
            if ($this->model->destroy($id)===false){
                return error();
            }
        }
        return ok();
    }

    /** 获取id排序所有数据
     * @return Response
     */
    public function getOrderByIdAllData(): Response
    {
        return successData($this->model->orderBy($this->model->getKeyName(),'asc')->get()->toArray());
    }


    /** 获取所有数据
     * @return Response
     */
    public function getAll(): Response
    {
        return successData($this->model->all($this->model->fields)->toArray());
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

    /** 列表
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $data=$this->model->getDataList();
        return paginate($data);
    }
}