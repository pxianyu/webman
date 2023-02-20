<?php

namespace app\model;

class RoleHasDepartments extends BaseModel
{
    protected $table = 'role_has_departments';

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

    protected $fillable=['department_id','role_id'];

    protected array $fields =['id','department_id','role_id','created_at','updated_at'];
}