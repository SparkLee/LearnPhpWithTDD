<?php

namespace Tests\Coroutines;

use App\Coroutines\Coroutines;
use Tests\TestCase;

class CoroutineTest extends TestCase
{
    /**
     * 用 php 5.6 执行此测试用例：
     * "D:\Software\php-5.6.23-Win32-VC11-x64\php" "E:\Program Files\PhpUnit\phpunit-5.7.25.phar" --configuration "D:\spark\PhpstormProjects\LearnPhpWithTDD\phpunit.xml" --filter "/(::test_xrange)( .*)?$/" "Tests\Coroutine\CoroutineTest" "D:\spark\PhpstormProjects\LearnPhpWithTDD\tests\Coroutine\CoroutineTest.php"
     */
    public function test_xrange()
    {
        //
        $xrange = Coroutines::xrange(1, 10);
        $expected = 1;
        foreach ($xrange as $num) {
            self::assertEquals($expected++, $num);
        }

        //
        $xrange = Coroutines::xrange(13, 99);
        self::assertEquals(13, $xrange->current());
        $xrange->next();
        self::assertEquals(14, $xrange->current());
        $xrange->next();
        self::assertEquals(15, $xrange->current());
    }
}
