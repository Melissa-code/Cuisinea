<?php

/**
 * explode a string to an array - separator : EOL (end of line) for the line break
 * @param $string
 * @return false|string[]
 */
function linesToArray(string $string): ?array {
    return explode(PHP_EOL, $string);
}
