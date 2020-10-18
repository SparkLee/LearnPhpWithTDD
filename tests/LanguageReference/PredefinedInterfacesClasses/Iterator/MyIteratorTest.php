<?php

namespace Tests\LanguageReference\PredefinedInterfacesClasses\Iterator;

use App\LanguageReference\PredefinedInterfacesClasses\Iterator\MyIterator;
use Tests\TestCase;

class MyIteratorTest extends TestCase
{
    public function test_手动调用迭代器的5个方法()
    {
        $iterator = new MyIterator();

        echo "1、获取迭代器当前元素：\n";
        self::assertEquals(1, $iterator->key());
        self::assertEquals("second-element", $iterator->current());
        self::assertTrue($iterator->valid());

        echo "\n2、重置迭代器(倒回迭代器的第一个元素)：\n";
        $iterator->rewind();
        self::assertEquals(0, $iterator->key());
        self::assertEquals("first-element", $iterator->current());
        self::assertTrue($iterator->valid());

        echo "\n3、迭代到下一个元素：\n";
        $iterator->next();
        $iterator->next();
        self::assertEquals(2, $iterator->key());
        self::assertEquals("last-element", $iterator->current());
        self::assertTrue($iterator->valid());

        echo "\n4、到达迭代器最后一个元素时，再往下迭代就会异常：\n";
        $iterator->next();
        self::assertEquals(3, $iterator->key());
        self::assertFalse($iterator->valid());
        try {
            self::assertEquals('', $iterator->current());
        } catch (\Exception $e) {
            echo "抛异常了：" . $e->getMessage();
        }
    }

    public function test_使用foreach遍历迭代器时_其实是自动调用迭代器的5个方法()
    {
        $iterator = new MyIterator();

        echo "1、每次使用foreach遍历迭代器时，第一步就是调用迭代器的rewind()方法将迭代器重置倒回到第一个元素\n";
        foreach ($iterator as $key => $value) {
            echo sprintf("键=%s, 值=%s\n\n", $key, $value);
        }

        echo "\n2、当foreach遍历迭代器遇到valid()为false时会自动结束遍历：\n";
        self::assertEquals(3, $iterator->key());
        self::assertFalse($iterator->valid());

        echo "\n3、再次使用foreach遍历迭代器：\n";
        foreach ($iterator as $item) {
            echo sprintf("值=%s\n\n", $item);
        }
    }

}
