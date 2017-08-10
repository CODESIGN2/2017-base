<?php

namespace CD2\Core\Utils\Functions;


function get_disabled_functions() : array {
    return array_filter(
      explode(
        ',',
        ini_get('disable_functions')
      )
    );
}

function is_disabled(string $func) : bool {
    return in_array($func, get_disabled_functions());
}

function func_enabled(string $func) : bool {
    return (
        (
            !is_null($func) && !empty($func) &&
            (!is_disabled($func))
            &&
            (function_exists($func))
        )
    );
}
