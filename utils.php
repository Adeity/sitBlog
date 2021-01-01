<?php
//  gets passed $_SESSION as array, returns false as default
function array_get($key, $array, $default="") {
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }
    else {
        return $default;
    }
}

//  search session with key from all sessions
function session_get($key, $default="") {
    return array_get($key, $_SESSION, $default);
}