<?php

namespace app\model;

class Permission extends BaseModel
{
    protected $table = 'permissions';

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

    protected $fillable = ['pid', 'title', 'route', 'sort', 'isHide', 'auth_open'];

    protected array $fields = ['id', 'pid', 'title', 'route', 'sort', 'isHide', 'auth_open', 'created_at', 'updated_at'];
    protected string $parentIdColumn='pid';

    protected bool $asTree = true;

    protected bool $isPaginate = false;
}