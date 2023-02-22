<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use support\Model;

class RoleHasPermission extends BaseModel
{
    protected $table = 'role_has_permissions';

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

    protected $fillable = ['permission_id', 'role_id'];

    protected array $fields = ['id', 'permission_id', 'role_id', 'created_at', 'updated_at'];
}