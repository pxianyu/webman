<?php

namespace app\model;

use app\Traits\DataRange;
use app\Traits\ModelTrait;
use app\Traits\WithAttr;
use app\Traits\WithRelations;
use DateTimeInterface;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Model;

class BaseModel extends Model
{
    use ModelTrait, DataRange, WithAttr;


    protected bool $asTree = false;

    protected bool $dataRange = false;

    protected string $parentIdColumn = 'parent_id';

    protected bool $isPaginate = true;

    protected array $fields = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $perPage = 10;

    public function __construct(array $attributes = [])
    {
        foreach (class_uses_recursive(static::class) as $trait) {
            if (str_contains($trait, 'DataRange')) {
                $this->setDataRange();
            }
        }
        parent::__construct($attributes);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function getDataList()
    {
        return $this->selects()->datarange()->paginate(request()->input('limit', $this->perPage))
            ->appends(request()->all());
    }

    protected function filterData(array $data): array
    {
        // 表单保存的数据集合
        $fillable = array_unique(array_merge($this->getFillable(), property_exists($this, 'form') ? $this->getForm() : []));

        foreach ($data as $k => $val) {
            if (is_null($val) || (is_string($val) && !$val)) {
                unset($data[$k]);
            }

            if (!empty($fillable) && !in_array($k, $fillable)) {
                unset($data[$k]);
            }

            if (in_array($k, [$this->getUpdatedAtColumn(), $this->getCreatedAtColumn()])) {
                unset($data[$k]);
            }
        }

        if (in_array($this->getCreatorIdColumn(), $this->getFillable())) {
            $data['creator_id'] = getAdminId();
        }

        return $data;
    }
}