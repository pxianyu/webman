<?php

namespace app\model;



use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Shopwwi\WebmanAuth\Facade\Auth;

class Admin extends BaseModel
{
    protected $table = 'admins';

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

    protected $fillable=['username','password','nickname','status','is_root'];

    protected $attributes=[
        'status'=>1,
        'is_root'=>1
    ];
    protected $hidden = [
        'password',
    ];
    public static function  getByUserName(string $username): Model|null
    {
        return self::username($username)->first();
    }

    /**
     * password
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => Auth::bcrypt($value),
        );
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_root;
    }
}