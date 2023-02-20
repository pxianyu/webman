<?php

namespace app\model;

use app\Traits\DataRange;
use app\Traits\ModelTrait;
use DateTimeInterface;
use Shopwwi\WebmanAuth\Facade\Auth;
use support\Log;
use support\Model;

class BaseModel extends Model
{
    use ModelTrait, DataRange;


    protected bool $asTree = false;

    protected bool $dataRange = false;

    protected string $parentIdColumn = 'parent_id';

    protected bool $isPaginate = true;

    protected array $fields = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $perPage=10;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        foreach (class_uses_recursive(static::class) as $trait) {
            if (str_contains($trait, 'DataRange')) {
                $this->setDataRange();
            }
        }
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    private function setDataRange(bool $use = true): static
    {
        $this->dataRange = $use;

        return $this;
    }

    public function setParentIdColumn(string $parentId): static
    {
        $this->parentIdColumn = $parentId;

        return $this;
    }

    public function getCreatorIdColumn(): string
    {
        return 'creator_id';
    }

    /**
     *
     * @return $this
     */
    protected function setCreatorId(): static
    {
        $this->setAttribute($this->getCreatorIdColumn(), Auth::guard('admin_api')->id());

        return $this;
    }

    public function ScopeSelects($query)
    {
        Log::info(property_exists($this, 'fields'));
        return $query->select(property_exists($this, 'fields') ?$this->fields :'*');

    }


    public function getDataList($request)
    {
        $this->selects()->paginate($request->input('limit',$this->perPage))
        ->appends($request->all());
    }

}