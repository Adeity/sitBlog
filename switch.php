<?php
if (isset($_COOKIE["brand_cookie"])){
    $brand_cookie_value = $_COOKIE["brand_cookie"];
    if($brand_cookie_value == "Blog"){
        $brand_cookie_value = "Bug";
        setcookie("brand_cookie", "Bug", time()+3*3600);
    }
    elseif ($brand_cookie_value == "Bug"){
        $brand_cookie_value = "Blog";
        setcookie("brand_cookie", "Blog", time()+3*3600);
    }
    else{
        $brand_cookie_value = "Blog";
        setcookie("brand_cookie", "Blog", time()+3*3600);
    }
}
header('Location: /semestralka');