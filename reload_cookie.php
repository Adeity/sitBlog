<?php
//  set ddefault values
$cookie_value = 0;
$checkbox_value = 0;

//  gets called if cookie exists. based on cookie value sets variables
function setReloadValues(){
    global $cookie_value, $checkbox_value;
    //  whitelisted skin_cookie value to 0 and 1
    if ($_COOKIE['skin_cookie'] == 0){
        $cookie_value = "light";
        $checkbox_value = "";
    }
    else if($_COOKIE['skin_cookie'] == 1){
        $cookie_value = "dark";
        $checkbox_value = "checked";
    }
    else{
        $cookie_value = "light";
        $checkbox_value = "";
    }
}

//  if cookie is set
if(isset($_COOKIE['skin_cookie'])) {
    setReloadValues();
}

//  if cookei isnt set, set one with default values.
else{
    setcookie("skin_cookie", 0, time()+3*3600);
    $cookie_value = "light";
    $checkbox_value = "";
}

?>