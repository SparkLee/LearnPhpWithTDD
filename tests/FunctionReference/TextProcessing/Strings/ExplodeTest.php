<?php

namespace Tests\FunctionReference\TextProcessing\Strings;

use Tests\TestCase;

/**
 * function explode() tests
 *
 * @see https://www.php.net/manual/en/function.explode.php
 * @author Spark Lee <liweijsj@163.com>
 * @since  2019/12/24
 */
class ExplodeTest extends TestCase
{
    public function test_Should_return_an_array_with_one_empty_element_Given_an_empty_string()
    {
        $arr = explode(',', '');

        $this->assertCount(1, $arr);
        $this->assertEquals('', $arr[0]);
    }

    public function test_Should_return_an_array_with_one_empty_element_Given_a_null()
    {
        $arr = explode(',', null);

        $this->assertCount(1, $arr);
        $this->assertEquals('', $arr[0]);
    }

    public function test_Should_return_an_array_with_one_space_element_Given_a_space_string()
    {
        $arr = explode(',', ' ');

        $this->assertCount(1, $arr);
        $this->assertEquals(' ', $arr[0]);
    }

    public function test_Should_return_an_array_with_one_element_equals_to_itself_Given_a_string_without_delimiter()
    {
        $arr = explode(',', 'abc');

        $this->assertCount(1, $arr);
        $this->assertEquals('abc', $arr[0]);
    }

    public function test_Should_return_an_array_with_two_elements_Given_a_string_with_one_delimiter()
    {
        $arr = explode(',', 'abc,中国人');

        $this->assertCount(2, $arr);
        $this->assertEquals('abc', $arr[0]);
        $this->assertEquals('中国人', $arr[1]);
    }

    /**
     * If limit is set and positive, the returned array will contain a maximum of limit elements with the last element containing the rest of string.
     */
    public function test_Should_return_an_array_with_one_element_equals_to_itself_Given_a_string_with_many_delimiters_and_limit_1()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北', 1);

        $this->assertCount(1, $arr);
        $this->assertEquals('abc,中国人,123,东西南北', $arr[0]);
    }

    /**
     * If the limit parameter is zero, then this is treated as 1.
     */
    public function test_Should_return_an_array_with_one_element_equals_to_itself_Given_a_string_with_many_delimiters_and_limit_0()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北', 0);

        $this->assertCount(1, $arr);
        $this->assertEquals('abc,中国人,123,东西南北', $arr[0]);
    }

    public function test_Should_return_an_array_with_two_elements_Given_a_string_with_many_delimiters_and_limit_2()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北', 2);

        $this->assertCount(2, $arr);
        $this->assertEquals('abc', $arr[0]);
        $this->assertEquals('中国人,123,东西南北', $arr[1]);
    }

    public function test_Should_return_an_array_with_4_elements_Given_a_string_with_three_delimiters_and_limit_event_more_than_4()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北', 10);

        $this->assertCount(4, $arr);
        $this->assertEquals('abc', $arr[0]);
        $this->assertEquals('中国人', $arr[1]);
        $this->assertEquals('123', $arr[2]);
        $this->assertEquals('东西南北', $arr[3]);
    }

    /**
     * If the limit parameter is negative, all components except the last -limit are returned.
     */
    public function test_Should_return_an_array_with_4_elements_Given_a_string_with_4_delimiters_and_limit_negative_1()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北,-+', -1);

        $this->assertCount(4, $arr);
        $this->assertEquals('abc', $arr[0]);
        $this->assertEquals('中国人', $arr[1]);
        $this->assertEquals('123', $arr[2]);
        $this->assertEquals('东西南北', $arr[3]);
    }

    public function test_Should_return_an_array_with_two_elements_Given_a_string_with_4_delimiters_and_limit_negative_3()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北,-+', -3);

        $this->assertCount(2, $arr);
        $this->assertEquals('abc', $arr[0]);
        $this->assertEquals('中国人', $arr[1]);
    }

    public function test_Should_return_an_empty_array_Given_a_string_with_4_delimiters_and_limit_negative_greater_than_or_equal_5()
    {
        $arr = explode(',', 'abc,中国人,123,东西南北,-+', -5);
        $this->assertTrue(is_array($arr));
        $this->assertCount(0, $arr);

        $arr = explode(',', 'abc,中国人,123,东西南北,-+', -10);
        $this->assertTrue(is_array($arr));
        $this->assertCount(0, $arr);
    }
}
