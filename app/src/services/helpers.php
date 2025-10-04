<?php

use App\security\XSSSanitizer;

if (!function_exists('e')) {
    function e($value)
    {
        return XSSSanitizer::sanitize($value);
    }
}
