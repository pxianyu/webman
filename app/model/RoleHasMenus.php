<?php

namespace app\model;

class RoleHasMenus extends BaseModel
{
    protected $table = 'role_has_menus';

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

    protected $fillable=['menu_id','role_id'];

    protected array $fields =['id','menu_id','role_id','created_at','updated_at'];
}