<?php

namespace app\model;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    protected $table = 'roles';

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

    protected $fillable=['name','desc','delete_flg','data_range'];

    protected array $fields=['id','name','desc','delete_flg','data_range'];
    /**
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }


    /**
     * departments
     *
     * @return BelongsToMany
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'role_has_departments', 'role_id', 'department_id');
    }
}