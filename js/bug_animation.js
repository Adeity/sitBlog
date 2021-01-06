//  set variableo of bug in footer
var bug = document.querySelector("#bug");

//  changes font size. change of css does the animation
function changeFontSize(){
    bug.classList.toggle("fs-1");
    bug.classList.toggle("fs-6");
}

//  rotates bug and changes font size
function rotateBug(){
    bug.removeEventListener('click', rotateBug);

    //  changes font size to smaller and then back to big
    changeFontSize()
    setTimeout(changeFontSize, 750)

    //  bug rotates left and right. bug is rotated right and will rotate left if he has rotate class
    bug.classList.toggle("rotate");

    //  rotate back
    setTimeout(function(){bug.addEventListener('click', rotateBug);}, 1000);
}

bug.addEventListener('click', rotateBug);