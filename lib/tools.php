<?php

/**
 * explode a string to an array - separator : EOL (end of line) for the line break
 * @param $string
 * @return false|string[]
 */
function linesToArray(string $string): ?array {
    return explode(PHP_EOL, $string);
}

/**
 * @param $text
 * @param string $divider
 * @return string
 */
function slugify($text, string $divider = '-'): string {
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, $divider);
    // remove duplicate
    $text = preg_replace('~-+~', $divider, $text);
    // lowercase
    $text = strtolower($text);

    if(empty($text)) {
        return 'n-a';
    }
    return $text;
}