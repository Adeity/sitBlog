
var siteBrand = document.querySelector("#brand-name")
var bug = document.querySelector("#bug");
bug.addEventListener('click', rotateBug);

function changeFontSize(){
    bug.classList.toggle("fs-1");
    bug.classList.toggle("fs-6");
}

function toggleOpacity(){
    siteBrand.classList.toggle("op-1");
    siteBrand.classList.toggle("op-0");
}

function getBrandName(){
    var brandName;
    if (!bug.classList.contains("rotate")){
        brandName = "Blog";
    }
    else {
        brandName = "Bug";
    }
    return brandName;
}

function changeBrandName(){
    toggleOpacity()
    setTimeout(function(){
            brandName = getBrandName()
            siteBrand.innerHTML = brandName;
            createCookie(name = "brand_cookie", value = brandName);
            toggleOpacity();
        }
        , 750);
}

function rotateBug(){
    changeBrandName()
    bug.removeEventListener('click', rotateBug);
    changeFontSize()
    setTimeout(changeFontSize, 750)
    bug.classList.toggle("rotate");
    setTimeout(function(){bug.addEventListener('click', rotateBug); location.reload()}, 1000);
}