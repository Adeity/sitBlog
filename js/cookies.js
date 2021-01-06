//  set body and skin mode checker variables
var documentBody = document.querySelector("body");
var colorSwitchCheck = document.querySelector("#colorSwitchCheck");

//  sets positive or negative time based on input parameter
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

//  creates cookie of name and value
function createCookie(name, value){
    var time = setTime(1);
    document.cookie =
        name + '=' + value +
        '; expires=' + time.toUTCString();
}

//  deletes cookie of name
function deleteCookie(name){
    //  sets negative time
    var time = setTime(0);
    document.cookie =
        name + '=' + 0 +
        '; expires=' + time.toUTCString();
}

//  reads cookie value based on name of cookie
function getCookieValue(name){
    cookieValue = (document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')[2]);
    return cookieValue;
}

//  gets color value based on wheter skin mode checker is checked or not
function getColorValue(){
    if(colorSwitchCheck.checked){
        colorValue = 1;
    }
    else{
        colorValue = 0;
    }
    return colorValue;
}

//  changes order on mainpage
function toggleOrder(){
    filtersCol = document.querySelector("#filters");
    maincontentCol = document.querySelector("#col-containing-main-content");
    if(filtersCol.classList.contains("order-first") && maincontentCol.classList.contains("order-last")){
        //  Change order of filters column
        filtersCol.classList.remove("order-first");
        filtersCol.classList.add("order-last");

        //  Change order or main_content column
        maincontentCol.classList.remove("order-last");
        maincontentCol.classList.add("order-first");
    }
    else{
        //  Change order of filters column
        filtersCol.classList.remove("order-last");
        filtersCol.classList.add("order-first");

        //  Change order or main_content column
        maincontentCol.classList.remove("order-first");
        maincontentCol.classList.add("order-last");
    }
}
document.querySelector("#colorSwitchCheck").addEventListener('click', toggleOrder);

//  changes skin mode
function setSkinMode() {
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
