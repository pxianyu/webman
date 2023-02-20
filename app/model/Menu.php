<?php

namespace app\model;

/**
 * @property integer $id (主键)
 * @property integer $pid 父ID
 * @property string $title 名称
 * @property string $name 组件key
 * @property string $icon 菜单图标
 * @property string $path vue路由
 * @property string $component 组件地址
 * @property string $roles 权限标识
 * @property string $menuType 菜单类型
 * @property string $redirect 重定向地址
 * @property integer $sort 菜单排序
 * @property integer $isHide 状态(0:禁用,1:启用)
 * @property integer $isAffix 固定(0:禁用,1:启用)
 * @property string $isLink 是否跳转(0:禁用,1:启用)
 * @property integer $isKeepAlive 是否缓存(0:禁用,1:启用)
 * @property integer $isIframe 是否iframe(0:禁用,1:启用)
 * @property mixed $created_at 
 * @property mixed $updated_at
 */
class Menu extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

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
    protected $fillable=['pid','title','name','icon','path','component','roles','menuType','redirect','sort','isHide','isAffix','isLink','isKeepAlive','isIframe','created_at','updated_at'];

    protected array $fields=['id','pid','title','name','icon','path','component','roles','menuType','redirect','sort','isHide','isAffix','isLink','isKeepAlive','isIframe','created_at','updated_at'];

    protected bool $asTree=true;

    protected bool $isPaginate=false;
}
