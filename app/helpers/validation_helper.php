<?php

/**
 * $check の文字数が $min 以上 $max 以下であれば true
 * @param string $check
 * @param string $min
 * @param string $max
 * @return bool
 */
function validate_between($check, $min, $max)
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}
