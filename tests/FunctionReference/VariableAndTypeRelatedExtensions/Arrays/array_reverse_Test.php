<?php

namespace Tests\FunctionReference\VariableAndTypeRelatedExtensions\Arrays;

use Tests\TestCase;

/**
 * function array_reverse tests
 *
 * @see https://www.php.net/manual/en/function.array-reverse.php
 * @author Spark Lee <liweijsj@163.com>
 * @since  2019/12/27
 */
class array_reverse_Test extends TestCase
{
    public function test_pure_numeric_keys_array_without_preserve_keys()
    {
        $arr = ['Spark', 'John', 'Martin', 'Bob'];
        $reversed = array_reverse($arr);

        $this->assertEquals(['Bob', 'Martin', 'John', 'Spark'], $reversed);
        $this->assertEquals('["Spark","John","Martin","Bob"]', json_encode($arr));
        $this->assertEquals('["Bob","Martin","John","Spark"]', json_encode($reversed));
    }

    public function test_pure_numeric_keys_array_with_preserve_keys()
    {
        $arr = ['Spark', 'John', 'Martin', 'Bob'];
        $reversed = array_reverse($arr, true);

        $this->assertEquals($arr, $reversed);
        $this->assertEquals(current($arr), end($reversed));
        $this->assertEquals('["Spark","John","Martin","Bob"]', json_encode($arr));
        $this->assertEquals('{"3":"Bob","2":"Martin","1":"John","0":"Spark"}', json_encode($reversed));

        $this->assertEquals($arr[0], $arr['0']);
        $this->assertEquals($reversed[3], $reversed['3']);
    }

    public function test_pure_non_numeric_keys_array_without_preserve_keys()
    {
        $arr = ['name' => 'Spark', 'alias' => 'Wei', 'fav' => 'Ping Pong'];
        $reversed = array_reverse($arr);

        $this->nonNumericKeysAlwaysBePreserved($arr, $reversed);
    }

    private function nonNumericKeysAlwaysBePreserved(array $arr, array $reversed): array
    {
        $this->assertEquals($arr, $reversed);
        $this->assertEquals(current($arr), end($reversed));
        $this->assertEquals('{"name":"Spark","alias":"Wei","fav":"Ping Pong"}', json_encode($arr));
        $this->assertEquals('{"fav":"Ping Pong","alias":"Wei","name":"Spark"}', json_encode($reversed));
        return $reversed;
    }

    /**
     * preserve_keys:
     * If set to TRUE numeric keys are preserved. Non-numeric keys
     * are not affected by this setting and will always be preserved.
     */
    public function test_pure_non_numeric_keys_array_with_preserve_keys()
    {
        $arr = ['name' => 'Spark', 'alias' => 'Wei', 'fav' => 'Ping Pong'];
        $reversed = array_reverse($arr, true);

        $this->nonNumericKeysAlwaysBePreserved($arr, $reversed);
    }

    public function test_numeric_keys_mixed_non_numeric_keys_array_without_preserve_keys()
    {
        $arr = [1, 'Spark', 'name' => 'Lily', 100, 'abc'];
        $reversed = array_reverse($arr);

        $this->assertEquals(current($arr), end($reversed));
        $this->assertEquals($arr[0], $reversed[3]);
        $this->assertEquals('{"0":1,"1":"Spark","name":"Lily","2":100,"3":"abc"}', json_encode($arr));
        $this->assertEquals('{"0":"abc","1":100,"name":"Lily","2":"Spark","3":1}', json_encode($reversed));
    }

    public function test_numeric_keys_mixed_non_numeric_keys_array_with_preserve_keys()
    {
        $arr = [1, 'Spark', 'name' => 'Lily', 100, 'abc'];
        $reversed = array_reverse($arr, true);

        $this->assertEquals(current($arr), end($reversed));
        $this->assertEquals($arr[0], $reversed[0]);
        $this->assertEquals('{"0":1,"1":"Spark","name":"Lily","2":100,"3":"abc"}', json_encode($arr));
        $this->assertEquals('{"3":"abc","2":100,"name":"Lily","1":"Spark","0":1}', json_encode($reversed));
    }
}
