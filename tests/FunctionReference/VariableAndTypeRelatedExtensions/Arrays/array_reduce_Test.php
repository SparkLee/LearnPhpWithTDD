<?php

namespace Tests\FunctionReference\VariableAndTypeRelatedExtensions\Arrays;

use Tests\TestCase;

/**
 * function array_reduce tests
 *
 * @see https://www.php.net/manual/en/function.array-reduce.php
 * @author Spark Lee <liweijsj@163.com>
 * @since  2019/12/27
 */
class array_reduce_Test extends TestCase
{
    public function test_add_up()
    {
        $input = [1, 2, 3, 4];
        $result = array_reduce($input, function ($carry, $num) {
            return $carry + $num;
        }, 0);

        $this->assertEquals(10, $result);
    }

    public function test_concatenate()
    {
        $input = ['I', 'am', 'Spark', 'Lee'];
        $result = array_reduce($input, function ($carry, $str) {
            return $carry . ' ' . $str;
        }, 'Hello World,');

        $this->assertEquals('Hello World, I am Spark Lee', $result);
    }

    public function test_Should_return_initial_Given_a_empty_input_array()
    {
        $result = array_reduce([], function ($carry, $str) {
            return $carry . $str;
        }, 'Hello World,');

        $this->assertEquals('Hello World,', $result);
    }

    public function test_Should_return_null_Given_a_empty_input_array_without_initial()
    {
        $result = array_reduce([], function ($carry, $str) {
            return 'do something.' . $carry . $str;
        });

        $this->assertNull($result);
    }

}
