<?php

namespace app\Traits;

trait ModelTrait
{
    public function scopeUsername($query,$username)
    {
        return $query->where('username',$username);
    }
    public function scopeNickname($query,$nickname)
    {
        return $query->where('nickname','like', '%'.$nickname.'%');
    }
    public function scopeStatus($query,$status)
    {
        return $query->where('status', $status);
    }
    public function scopeIsRoot($query,$is_root)
    {
        return $query->where('is_root', $is_root);
    }

}