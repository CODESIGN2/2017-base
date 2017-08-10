<?php

namespace cd2\tests;

use PHPUnit\Framework\TestCase;

use function CD2\Core\Utils\Functions\{func_enabled,is_disabled,get_disabled_functions};


class TestFuncUtilsReqDisabled extends TestCase
{
    protected function setUp() {
        $this->disabled_functions = get_disabled_functions();
        if (empty($this->disabled_functions)) {
            $this->markTestSkipped('needs at least one disabled function');
        }
    }

    /**
     * @test
     * @requires function array_rand, count
     */
    public function func_enabled_returns_false_for_disabled_function() {
        $rand_idx = array_rand($this->disabled_functions);
        $funcPick = $this->disabled_functions[$rand_idx];
        $this->assertFalse(func_enabled($funcPick), "function '{$funcPick}' is not enabled");
    }

    /**
     * @test
     * @requires function array_rand, count
     */
    public function is_disabled_returns_true_for_disabled_function() {
        $rand_idx = array_rand($this->disabled_functions);
        $funcPick = $this->disabled_functions[$rand_idx];
        $this->assertTrue(is_disabled($funcPick), "function '{$funcPick}' is not disabled");
    }
}
