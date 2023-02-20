<?php

namespace app\model;

use app\Traits\ModelTrait;
use DateTimeInterface;
use support\Model;

class BaseModel extends Model
{
    use ModelTrait;
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}