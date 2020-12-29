var documentBody = document.querySelector("body");
var colorSwitchCheck = document.querySelector("#colorSwitchCheck");



function setTime(n){
    var now = new Date();
    var time = now.getTime();
    if (n > 0){
        time += 60 * 60 * 24 * 1000 * 3;
    }
    else if(n < 1){
        time -= 60 * 60 * 24 * 1000 * 3;
    }
    now.setTime(time);
    return now;
}

function createCookie(name, value){
    var time = setTime(1);
    document.cookie =
        name + '=' + value +
        '; expires=' + time.toUTCString();
}

function deleteCookie(name){
    var time = setTime(0);
    document.cookie =
        name + '=' + 0 +
        '; expires=' + time.toUTCString();
}

function getCookieValue(name){
    cookieValue = (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')[2]);
    return cookieValue;
}

function getColorValue(){
    if(colorSwitchCheck.checked){
        colorValue = 1;
    }
    else{
        colorValue = 0;
    }
    return colorValue;
}

function setColorMode() {
    n = getColorValue();
    cookieValue = getCookieValue("skin_cookie");
    if (cookieValue == null){
        createCookie(name = "skin_cookie", value = n);
    }
    else if(cookieValue > n || cookieValue < n){
        createCookie(name = "skin_cookie", value = n);
    }
    if (n < 1){
        documentBody.classList="light";
    }
    else {
        documentBody.classList="dark";
    }
}

function setBrandName() {
    brandValue = getCookieValue("brand_cookie");
    if (brandValue == null){
        createCookie(name = "brand_cookie", value = n);
    }
    else if(brandValue > n || brandValue < n){
        createCookie(name = "brand_cookie", value = n);
    }
    if (n < 1){
        documentBody.classList="light";
    }
    else {
        documentBody.classList="dark";
    }
}