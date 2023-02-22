<?php

namespace app\model;


/**
 * @property integer $id (主键)
 * @property integer $banner_group_id 分组序号
 * @property string $pic 图片地址
 * @property string $link 跳转链接
 * @property string $title 标题
 * @property string $subtitle 副标题/描述
 * @property integer $sort 排序
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Banner extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banners';

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
    protected $fillable = ['banner_group_id', 'pic', 'link', 'title', 'subtitle', 'sort', 'created_at', 'updated_at'];

    protected array $fields = ['id', 'banner_group_id', 'pic', 'link', 'title', 'subtitle', 'sort', 'created_at', 'updated_at'];

}
