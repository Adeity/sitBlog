<?php
$cookie_value = 0;
$checkbox_value = 0;
function setReloadValues(){
    global $cookie_value, $checkbox_value;
    if ($_COOKIE['skin_cookie'] == 0){
        $cookie_value = "light";
        $checkbox_value = "";
    }
    else{
        $cookie_value = "dark";
        $checkbox_value = "checked";
    }
}

if(isset($_COOKIE['skin_cookie'])) {
    setReloadValues();
}

else{
    $cookie_value = "light";
    $checkbox_value = "";
}


if (isset($_COOKIE["brand_cookie"])){
    $brand_cookie_value = $_COOKIE["brand_cookie"];
    if($brand_cookie_value == "Blog"){
        $bug_rotate_value = "";
    }
    elseif ($brand_cookie_value == "Bug"){
        $bug_rotate_value = "rotate";
    }
    else{
        $bug_rotate_value = "";
    }
}
else {
    setcookie("brand_cookie", "Blog", time()+3*3600);
    $brand_cookie_value = "Blog";
}

?>