<?php

namespace app\model;

use support\Model;

class Permission extends Model
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

    protected $fillable=['pid','title','route','sort','isHide','auth_open'];

}