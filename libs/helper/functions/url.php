<?php

/**
 * Check if url exists or not.
 *
 * @param string $url
 * @return bool
 */
function urlExists($url)
{
    if ($url == null) return false;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($httpCode >= 200 && $httpCode < 300);
}

/**
 * Get url last part.
 *
 * @param string $url
 * @return mixed
 */
function getUrlLastPart($url)
{
    return end(explode('/', $url));
}
