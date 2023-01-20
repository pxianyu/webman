<?php
declare(strict_types=1);
namespace app\model;

use Illuminate\Database\Eloquent\Builder;
use support\Model;

class User extends Model
{
    protected $table = 'users';

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

    public static function  getByUserName(string $username): Builder|null
    {
        return self::where('username',$username)->first();
    }

}