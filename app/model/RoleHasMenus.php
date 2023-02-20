<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use support\Model;

class RoleHasMenus extends Model
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


}