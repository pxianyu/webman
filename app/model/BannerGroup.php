<?php

namespace app\model;

use support\Model;

/**
 * @property integer $id (主键)
 * @property string $name 分组名称
 * @property mixed $created_at 
 * @property mixed $updated_at
 */
class BannerGroup extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner_groups';

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
    protected $fillable=['name','created_at','updated_at'];
    
}
