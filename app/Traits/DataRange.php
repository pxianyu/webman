<?php

namespace app\Traits;

use app\Enum\DataRangeEnum;
use app\model\Admin;
use app\model\Department;
use app\model\Role;
use Illuminate\Support\Collection;
use Shopwwi\WebmanAuth\Facade\Auth;

trait DataRange
{
    /**
     * 数据权限作用域
     * @param $query
     * @param array|Collection $roles
     * @return mixed
     */
    public function scopeDataRange($query, array|Collection $roles = []): mixed
    {
        $currenUser = Auth::guard('admin_api')->user();

        if ($currenUser->isSuperAdmin()) {
            return $query;
        }
        $userIds = $this->getDepartmentUserIdsBy($roles, $currenUser);
        if (empty($userIds)) {
            return $query;
        }
        if ($this->getDataRange()) {
            return $query->whereIn('creator_id', $userIds);
        }
        return $query;
    }

    /**
     * get department ids
     *
     * @param array $roles
     * @param $currentUser
     * @return Collection
     */
    public function getDepartmentUserIdsBy(array $roles, $currentUser): Collection
    {
        $userIds = Collection::make();

        if (empty($roles)) {
            $roles = $currentUser->roles()->get();
        }

        /* @var Role $role */
        foreach ($roles as $role) {
            if (DataRangeEnum::All_Data->assert($role->data_range)) {
                return Collection::make();
            }

            if (DataRangeEnum::Personal_Choose->assert($role->data_range)) {
                $userIds = $userIds->merge($this->getUserIdsByDepartmentId($role->departments()->pluck('id')));
            }

            if (DataRangeEnum::Personal_Data->assert($role->data_range)) {
                $userIds = $userIds->push($currentUser->id);
            }

            if (DataRangeEnum::Department_Data->assert($role->data_range)) {
                $userIds = $userIds->merge(
                    $this->getUserIdsByDepartmentId([$currentUser->department_id])
                );
            }

            if (DataRangeEnum::Department_DOWN_Data->assert($role->data_range)) {
                $departmentsId = [$currentUser->department_id];

                $departmentModel = new Department();

                $departmentIds = $departmentModel->findFollowDepartments($departmentsId);

                $userIds = $userIds->merge($this->getUserIdsByDepartmentId($departmentIds))->push($currentUser->id);
            }
        }

        return $userIds->unique();
    }


    /**
     * get user ids by department is
     *
     * @param array|Collection $departmentIds
     * @return Collection
     */
    protected function getUserIdsByDepartmentId(array|Collection $departmentIds): Collection
    {
        return Admin::whereIn('department_id', $departmentIds)->pluck('id');
    }
}