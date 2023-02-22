<?php

namespace app\Enum;

enum StatusEnum: int
{
    case Enable = 1;

    case Disable = 0;

    /**
     * @desc name
     *
     */
    public function name(): string
    {
        return match ($this) {
            self::Enable => '启用',
            self::Disable => '禁用'
        };
    }

    /**
     * get value
     *
     * @return int
     */
    public function value(): int
    {
        return match ($this) {
            self::Enable => 1,
            self::Disable => 0,
        };
    }
}
