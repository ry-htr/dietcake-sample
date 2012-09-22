<?php

/**
 * echo escaped string
 * @param string $string
 */
function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

/**
 * return escaped and nl2br string
 * @param string $s
 * @return string
 */
function readable_text($s)
{
    return nl2br(htmlspecialchars($s, ENT_QUOTES));
}
