<?php

namespace app\model;

/**
 * @property integer $id (主键)
 * @property string $name 组名称
 */
class ConfigGroup extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'config_groups';

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
    public $timestamps = false;
    protected $fillable=['name'];
    protected array $fields=['id','name'];
}
