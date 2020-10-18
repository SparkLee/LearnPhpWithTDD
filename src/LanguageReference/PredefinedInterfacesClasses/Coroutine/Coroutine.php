<?php

namespace App\LanguageReference\PredefinedInterfacesClasses\Coroutine;

use Generator;

/**
 * @see Laruence-在PHP中使用协程实现多任务调度 https://www.laruence.com/2015/05/28/3038.html
 * @see Cooperative multitasking using coroutines (in PHP!) http://nikic.github.io/2012/12/22/Cooperative-multitasking-using-coroutines-in-PHP.html
 */
class Coroutine
{
    /**
     * @param int $start
     * @param int $end
     * @param int $step
     *
     * @return Generator
     */
    public static function xRange($start, $end, $step = 1)
    {
        for ($i = $start; $i <= $end; $i += $step) {
            yield $i;
        }
    }
}