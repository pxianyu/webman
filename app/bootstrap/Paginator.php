<?php

namespace app\bootstrap;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Webman\Bootstrap;
use Workerman\Worker;

class Paginator implements Bootstrap
{

    public static function start(?Worker $worker)
    {
        Container::getInstance()->bind(LengthAwarePaginator::class, function (Container $app, array $options) {
            return new class ($options['items'], $options['total'], $options['perPage'], $options['currentPage'], $options['options']) extends LengthAwarePaginator {
                /**
                 * @inheritDoc
                 */
                public function toArray(): array
                {
                    return [
                        'data' => $this->items->toArray(),
                        'total' => $this->total(),
                        'per_page' => $this->perPage(),
                        'lastPage'=>$this->lastPage(),
                    ];
                }
            };
        });
    }
}