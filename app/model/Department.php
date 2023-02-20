<?php

namespace app\model;

use support\Model;

/**
 * @property integer $id (主键)
 * @property integer $parent_id 父级ID
 * @property string $department_name 部门名称
 * @property string $principals 负责人
 * @property string $mobile 负责人联系方式
 * @property string $email 邮箱
 * @property string $status 状态
 * @property string $sort 排序
 * @property integer $creator_id 
 * @property string $created_at 
 * @property string $updated_at 
 * @property string $deleted_at
 */
class Department extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    protected $fillable=['parent_id','department_name','principals','mobile','email','status','sort','creator_id','created_at','updated_at','deleted_at'];

    public function findFollowDepartments(int|array $id): array
    {
        if (!is_array($id)) {
            $id = [$id];
        }

        $followDepartmentIds = $this->whereIn('parent_id', $id)->pluck('id')->toArray();

        if (! empty($followDepartmentIds)) {
            $followDepartmentIds = array_merge($followDepartmentIds, $this->findFollowDepartments($followDepartmentIds));
        }

        return $followDepartmentIds;
    }

}
