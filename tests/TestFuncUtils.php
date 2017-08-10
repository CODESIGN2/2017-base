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
}
