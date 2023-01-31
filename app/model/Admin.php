<?php
declare(strict_types=1);
namespace app\model;

use support\Model;

class Admin extends Model
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
    public $timestamps = false;

    protected $fillable=['username','password','nickname','status','is_root'];

    protected $attributes=[
        'status'=>1,
        'is_root'=>1
    ];

    public static function  getByUserName(string $username): \Illuminate\Database\Eloquent\Model|null
    {
        return self::where('username', $username)->first();
    }

}