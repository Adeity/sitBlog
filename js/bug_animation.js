
var siteBrand = document.querySelector("#brand-name")
var bug = document.querySelector("#bug");
bug.addEventListener('click', rotateBug);

function changeFontSize(){
    bug.classList.toggle("fs-1");
    bug.classList.toggle("fs-6");
}

function rotateBug(){
    bug.removeEventListener('click', rotateBug);
    changeFontSize()
    setTimeout(changeFontSize, 750)
    bug.classList.toggle("rotate");
    setTimeout(function(){bug.addEventListener('click', rotateBug);}, 1000);
}