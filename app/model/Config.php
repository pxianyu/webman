<?php

namespace app\model;

use support\Model;

/**
 * @property integer $id (主键)
 * @property string $name 配置名称
 * @property string $key 配置键
 * @property mixed $option 选项
 * @property string $value 配置值
 * @property integer $type 配置类型 1:input 2:textarea 3:select 4:radio 5:checkbox 6:file 7:image 8:color 9:date 10:time 11:datetime
 * @property integer $config_group_id 
 * @property string $remark 备注
 * @property string $suffix 默认值的后缀
 */
class Config extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configs';

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
    protected $fillable=['name','key','option','value','type','config_group_id','remark','suffix'];
    
}
