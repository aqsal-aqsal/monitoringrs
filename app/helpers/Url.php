<?php
namespace App\Helpers;

class Url
{
    public static function base(): string
    {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
        if ($base === '/' || $base === '\\') {
            $base = '';
        }
        return $base;
    }

    public static function to(string $path): string
    {
        return self::base() . $path;
    }
}
