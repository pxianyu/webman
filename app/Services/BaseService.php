<?php

namespace app\Services;

use app\Common\ArrUtil;
use app\Enum\CodeEnum;
use app\Enum\MessageEnum;
use app\Enum\StatusEnum;
use app\Request;
use support\Response;

class BaseService
{
    protected $form;
    protected $model;

    /** 更新状态
     * @param int $id
     * @param string $field
     * @return Response
     */
    public function toggleBy(int $id, string $field = 'status'): Response
    {
        if (!is_numeric($id) || !$id) {
            return error(MessageEnum::NOT_FOUND_ERROR,CodeEnum::NOT_FOUND);
        }
        $model = $this->model->findorfail($id);
        $model->$field = $model->$field === StatusEnum::Enable->value() ? StatusEnum::Disable->value() : StatusEnum::Enable->value();
        $model->save();
        return ok();
    }

    /** 根据id更新数据
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateById(Request $request, int $id): Response
    {
        if (!is_numeric($id) || !$id) {
            return error(MessageEnum::NOT_FOUND_ERROR,CodeEnum::NOT_FOUND);
        }
        $this->setForm($request);
        $model = $this->model->findorfail($id);
        $res = $model->update($this->form);
        if ($res === false) {
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
        if (!is_numeric($id) || !$id) {
            return error(MessageEnum::NOT_FOUND_ERROR,CodeEnum::NOT_FOUND);
        }
        if ($this->model->getAsTree() && $this->model->where($this->model->getParentIdColumn(), $id)->exists()) {
            return error('无法进行删除，请先删除子级');
        }
        if ($this->model->getDataRange()) {
            $this->model->where($this->model->getKeyName(), $id)->datarange()->delete();
        } else {
            if ($this->model->destroy($id) === false) {
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
        return successData($this->model->orderBy($this->model->getKeyName(), 'asc')->get()->toArray());
    }


    /** 获取所有数据
     * @return Response
     */
    public function getAll(): Response
    {
        return successData($this->model->all($this->model->getFields())->toArray());
    }

    public function getTreeData():array
    {
        return ArrUtil::toTreeAssoc($this->model->all($this->model->getFields())->toArray(),$this->model->getKeyName(), $this->model->getParentIdColumn());
    }
    /** 设置表单字段
     * @param Request $request
     * @return void
     */
    public function setForm(Request $request): void
    {
        $this->form = $request->all();
    }

    /** 新增数据
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $this->setForm($request);
        $res = $this->model->create($this->form);
        if (!$res) {
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
        if (!is_numeric($id) || !$id) {
            return error(MessageEnum::NOT_FOUND_ERROR,CodeEnum::NOT_FOUND);
        }
        return successJsonData($this->model->findorfail($id));
    }

    /** 列表
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($this->model->getAsTree()) {
            $data= $this->getTreeData();
        }else{
            $data= $this->model->getDataList()->toArray();
        }
        return successData($data);
    }
}