<?php
function array_get($key, $array, $default="") {
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }
    else {
        return $default;
    }
}

function session_get($key, $default="") {
    return array_get($key, $_SESSION, $default);
}