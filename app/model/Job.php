<?php

namespace app\model;

/**
 * @property integer $id (主键)
 * @property string $job_name
 * @property integer $status
 * @property integer $sort
 * @property string $description
 * @property integer $creator_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Job extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

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

    protected $fillable = ['job_name', 'status', 'sort', 'description', 'creator_id', 'created_at', 'updated_at', 'deleted_at'];

    protected array $fields = ['id', 'job_name', 'status', 'sort', 'description', 'creator_id', 'created_at', 'updated_at', 'deleted_at'];
}
