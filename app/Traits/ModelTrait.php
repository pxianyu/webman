<?php

namespace app\Traits;

trait ModelTrait
{
    public function scopeUsername($query, $username)
    {
        return $query->when($username, function ($builder) use ($username) {
            return $builder->where('username', $username);
        });
    }

    public function scopeNickname($query, $nickname)
    {
        return $query->when($nickname, function ($builder) use ($nickname) {
            return $builder->where('nickname', $nickname);
        });
    }

    public function scopeStatus($query, $status)
    {
        return $query->when($status, function ($builder) use ($status) {
            return $builder->where('status', $status);
        });
    }

    public function scopeIsRoot($query, $is_root)
    {
        return $query->when($is_root, function ($builder) use ($is_root) {
            return $builder->where('is_root', $is_root);
        });
    }
    public function ScopeSelects($query)
    {
        return $query->select(property_exists($this, 'fields') ? $this->fields : '*');

    }
}