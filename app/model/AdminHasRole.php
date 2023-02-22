<?php

namespace app\model;

class AdminHasRole extends BaseModel
{
    protected $table = 'admin_has_roles';

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

    protected $fillable = ['admin_id', 'role_id'];

    protected array $fields = ['id', 'admin_id', 'role_id', 'created_at', 'updated_at'];

    /**
     * @param $admin_id
     * @param $role_id
     * @return void
     */
    public function addAdmin($admin_id, $role_id): void
    {
        $this->create([
            'admin_id' => $admin_id,
            'role_id' => $role_id
        ]);
    }


}