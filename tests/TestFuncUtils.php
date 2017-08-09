<?php

namespace cd2\tests;

use PHPUnit\Framework\TestCase;

use function CD2\Core\Utils\Functions\{func_enabled,is_disabled,get_disabled_functions};


class TestFuncUtils extends TestCase
{
    /**
     * @test
     * @requires function is_array
     */
    public function get_disabled_functions_returns_array() {
        $this->assertTrue(is_array(get_disabled_functions()));
    }

    /**
     * @test
     */
    public function is_disabled_returns_false_for_non_existant_function() {
        $this->assertFalse(is_disabled('IJustGotMadeUpOnAWhim'));
    }

    /**
     * @test
     */
    public function func_enabled_returns_false_for_non_existant_function() {
        $this->assertFalse(func_enabled('IJustGotMadeUpOnAWhim'));
    }

    /**
     * @test
     * @requires function ini_get
     */
    public function func_enabled_returns_true_for_existing_function() {
        $this->assertTrue(func_enabled('ini_get'));
    }

    /**
     * @test
     * @requires function array_rand, count
     */
    public function func_enabled_returns_false_for_disabled_function() {
        $disabled_functions = get_disabled_functions();
        if (count($disabled_functions) > 0) {
            $funcPick = $disabled_functions[array_rand($disabled_functions)];
            $this->assertFalse(func_enabled($funcPick), "function '{$funcPick}' is not enabled");
        } else {
            $this->markTestSkipped('needs at least one disabled function');
        }
    }

    /**
     * @test
     * @requires function array_rand, count
     */
    public function is_disabled_returns_true_for_disabled_function() {
        $disabled_functions = get_disabled_functions();
        if (count($disabled_functions) > 0) {
            $funcPick = $disabled_functions[array_rand($disabled_functions)];
            $this->assertTrue(is_disabled($funcPick), "function '{$funcPick}' is not disabled");
        } else {
            $this->markTestSkipped('needs at least one disabled function');
        }
    }
}
