<?php

namespace Tests\FunctionReference\VariableAndTypeRelatedExtensions\Arrays\SortingArrays;

use Tests\TestCase;

/**
 * function array_multisort tests
 *
 * @author Spark Lee <liweijsj@163.com>
 * @since  2020/6/23
 *
 * @see https://www.php.net/manual/zh/function.array-multisort.php
 * @see https://www.php.net/manual/zh/array.sorting.php
 *
 */
class array_multisort_Test extends TestCase
{
    /**
     * 一维索引数组
     */
    public function test_array_multisort_one_dimensional_numeric_array()
    {
        // 纯数字
        $arr = [1, 3, 19, 100, 0, 998];

        array_multisort($arr, SORT_DESC, SORT_NUMERIC);
        self::assertSame([998, 100, 19, 3, 1, 0], $arr);

        array_multisort($arr, SORT_ASC);
        self::assertSame([0, 1, 3, 19, 100, 998], $arr);

        // 纯字符串
        $strArr = ['a', 'li', 'Spark', 'b', '01', '20', 'Wei'];

        array_multisort($strArr, SORT_DESC, SORT_STRING);
        self::assertEquals(['li', 'b', 'a', 'Wei', 'Spark', '20', '01'], $strArr);

        array_multisort($strArr, SORT_ASC);
        self::assertEquals(['01', '20', 'Spark', 'Wei', 'a', 'b', 'li'], $strArr);

        // 数字+字符串
        $xArr = ['a', 'A001', 10, 89, 'X', 'x', '20'];
        array_multisort($xArr);
        self::assertSame(['20', 'A001', 'X', 'a', 'x', 10, 89], $xArr);
    }

    public function test_array_multisort_one_dimensional_associate_array()
    {
        $arr = [
            'n1' => 100,
            'n2' => 98,
            'n3' => 1,
            'n4' => 33,
        ];

        array_multisort($arr);
        self::assertSame([
            'n3' => 1,
            'n4' => 33,
            'n2' => 98,
            'n1' => 100,
        ], $arr);

        array_multisort($arr, SORT_DESC);
        self::assertSame([
            'n1' => 100,
            'n2' => 98,
            'n4' => 33,
            'n3' => 1,
        ], $arr);
    }

    public function test_array_multisort_two_dimensional_associate_array()
    {
        $arr = [
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
        ];
        $columnArr = array_column($arr, 'n4');

        array_multisort($columnArr, $arr);
        self::assertSame([
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
        ], $arr);

        array_multisort($columnArr, SORT_DESC, $arr);
        self::assertSame([
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
        ], $arr);
    }

    public function test_array_multisort_two_dimensional_associate_array2()
    {
        $arr = [
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
        ];
        $arr2 = [
            ['item3' => 100, 'item4' => 33],
            ['item3' => 2, 'item4' => 1],
            ['item3' => 300, 'item4' => 777],
            ['item3' => 4, 'item4' => 777],
        ];

        $columnArr = array_column($arr, 'n4');
        array_multisort($columnArr, $arr, $arr2);
        self::assertSame([
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
        ], $arr);
        self::assertSame([
            ['item3' => 300, 'item4' => 777],
            ['item3' => 100, 'item4' => 33],
            ['item3' => 2, 'item4' => 1],
            ['item3' => 4, 'item4' => 777],
        ], $arr2);

        // This argument(array1_sort_order) can be swapped with array1_sort_flags or omitted entirely, in which case SORT_ASC is assumed.
        // This argument(array1_sort_flags) can be swapped with array1_sort_order or omitted entirely, in which case SORT_REGULAR is assumed.
        array_multisort($columnArr, SORT_NUMERIC, SORT_DESC, $arr, $arr2);
        self::assertSame([
            ['n3' => 4, 'n4' => 998, 'n2' => 78, 'n1' => 100],
            ['n3' => 2, 'n4' => 100, 'n2' => 5, 'n1' => 88],
            ['n3' => 1, 'n4' => 33, 'n2' => 98, 'n1' => 100],
            ['n3' => 3, 'n4' => 12, 'n2' => 98, 'n1' => 5],
        ], $arr);
        self::assertSame([
            ['item3' => 4, 'item4' => 777],
            ['item3' => 2, 'item4' => 1],
            ['item3' => 100, 'item4' => 33],
            ['item3' => 300, 'item4' => 777],
        ], $arr2);
    }

    public function test_array_multisort_multi_dimensional()
    {
        $arr = [
            ["10", 11, 100, 100, "a"],
            [1, 2, "2", 3, 1],
        ];
        array_multisort($arr[0], SORT_ASC, SORT_STRING, $arr[1], SORT_NUMERIC, SORT_DESC);
        self::assertSame([
            ["10", 100, 100, 11, "a"],
            [1, 3, "2", 2, 1],
        ], $arr);
    }


}
