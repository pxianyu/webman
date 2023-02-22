<?php

namespace app\model;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $fillable = ['username', 'password', 'nickname', 'status', 'is_root'];

    protected array $fields = ['id', 'username', 'nickname', 'status', 'is_root', 'created_at', 'updated_at'];

    protected bool $dataRange = true;
    protected $hidden = [
        'password',
    ];

    public static function getByUserName(string $username): Model|null
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
            set: fn($value) => Auth::bcrypt($value),
        );
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_root;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'admin_has_roles', 'admin_id', 'role_id');
    }

    public function getPaginateData($username, $nickname, $status, $limit)
    {
        return $this->selects()
            ->username($username)
            ->datarange()
            ->nickname($nickname)
            ->status($status)
            ->paginate($limit)
            ->appends(request()->all());
    }
}