<?php

use Carbon\Carbon;

if (!function_exists('get_full_name')) {
    function get_full_name($first_name = null, $last_name = null)
    {
        return $first_name . ' ' . $last_name;
    }
}

if (!function_exists('convert_mysql_boolean')) {
    function convert_mysql_boolean($boolean_value = false)
    {
        if ($boolean_value === true || $boolean_value === 'true') {
            return 1;
        } else if ($boolean_value === false || $boolean_value === 'false') {
            return 0;
        }

        return false;
    }
}

if (!function_exists('convert_mysql_to_normal_boolean')) {
    function convert_mysql_to_normal_boolean($boolean_value = 0)
    {
        return $boolean_value == 1 ? true : false;
    }
}

if (!function_exists('convert_string_to_boolean')) {
    function convert_string_to_boolean($boolean_value = 'false')
    {
        if ($boolean_value === 'true') {
            return true;
        }

        return false;
    }
}

if (!function_exists('format_date')) {
    function format_date($value, $format_pattern)
    {
        if (!$value || !$format_pattern) {
            return null;
        }

        return Carbon::parse($value)->format($format_pattern);
    }
}

if (!function_exists('get_current_date')) {
    function get_current_date($format_pattern)
    {
        $date = Carbon::now();
        if (!$format_pattern) {
            return $date;
        }

        return $date->format($format_pattern);
    }
}

if (!function_exists('generate_file_url')) {
    function generate_file_url($file)
    {
        if (!$file) {
            return null;
        }

        return env('ASSET_URL') . $file;
    }
}
