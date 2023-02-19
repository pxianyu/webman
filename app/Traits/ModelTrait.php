<?php

namespace app\Traits;

trait ModelTrait
{
    public function scopeUsername($query,$username)
    {
        return $query->where('username', $username);
    }
}