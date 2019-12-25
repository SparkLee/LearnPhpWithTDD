<?php

namespace Tests\LanguageReference\Operators;

use Tests\TestCase;

/**
 * function array operators tests
 *
 * @see https://www.php.net/manual/en/language.operators.array.php
 * @author Spark Lee <liweijsj@163.com>
 * @since  2019/12/25
 */
class ArrayOperatorsTest extends TestCase
{
    /**
     * The + operator returns the right-hand array appended to the left-hand array;
     * for keys that exist in both arrays, the elements from the left-hand array will
     * be used, and the matching elements from the right-hand array will be ignored.
     *
     * Example | Name  | Result
     * ------------------------------------
     * $a + $b | Union | Union of $a and $b.
     */
    public function test_union()
    {
        // 数组相加(合并)，右边数组加在左边数组后面
        $a = [1, 2, 3];
        $b = ['name' => 'Spark Lee', 'age' => 18];
        $this->assertEquals([1, 2, 3, 'name' => 'Spark Lee', 'age' => 18], $a + $b);
        // 只要 key 相同，数组元素的书写顺序是无关紧要的
        $this->assertEquals([1, 2, 3, 'name' => 'Spark Lee', 'age' => 18], $b + $a);
        $this->assertEquals(['name' => 'Spark Lee', 'age' => 18, 1, 2, 3], $a + $b);
        $this->assertEquals(['name' => 'Spark Lee', 'age' => 18, 1, 2, 3], $b + $a);
        $this->assertEquals([1, 2, 'name' => 'Spark Lee', 'age' => 18, 3], $a + $b);
        $this->assertEquals([1, 'age' => 18, 'name' => 'Spark Lee', 2, 3], $b + $a);

        $a = [1, 2, 3];
        $b = [];
        $this->assertEquals($a, $a + $b);
        $this->assertEquals($a, $b + $a);

        // 若 key 相同，则取左边值，右边值被忽略 | 故索引数组合并不能用'+'，得用 array_merge()
        $a = [1, 2, 3];
        $b = ['a', 'b', 'c', 'd', 'abc'];
        $this->assertEquals([1, 2, 3, 'd', 'abc'], $a + $b);

        $a = ['name' => 'Spark Lee', 'age' => 18];
        $b = ['name' => '李', 'fav' => 'Coding'];
        $this->assertEquals(['name' => 'Spark Lee', 'age' => 18, 'fav' => 'Coding'], $a + $b);
    }

}
