<?php
/**
 * These hacks allow hosting the framework on servers with php version < 5.3
 */
if ((float)phpversion() > 5.2) return;

/**
 * Retrofit the lcfirst function if it is not defined
 */
if (!function_exists('lcfirst')) {
    function lcfirst($string) {
        return substr_replace($string, strtolower(substr($string, 0, 1)), 0, 1);
    }
}