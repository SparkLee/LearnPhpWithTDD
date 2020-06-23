<?php

namespace App\Coroutines;

use Generator;

/**
 * @see Laruence-在PHP中使用协程实现多任务调度 https://www.laruence.com/2015/05/28/3038.html
 * @see Cooperative multitasking using coroutines (in PHP!) http://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html
 */
class Coroutines
{
    /**
     * @return Generator
     */
    public static function xrange($start, $end, $step = 1)
    {
        for ($i = $start; $i <= $end; $i += $step) {
            yield $i;
        }
    }
}