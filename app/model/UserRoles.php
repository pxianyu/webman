<?php

namespace app\model;

use support\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';

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

    protected $fillable=['admin_id','role_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @param $admin_id
     * @param $role_id
     * @return void
     */
    public function addAdmin($admin_id,$role_id)
    {
        $this->create([
            'admin_id' => $admin_id,
            'role_id' => $role_id
        ]);
    }


}