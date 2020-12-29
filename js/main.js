function include(file) {

    var script  = document.createElement('script');
    script.src  = file;
    script.type = 'text/javascript';
    script.defer = true;

    document.getElementsByTagName('head').item(0).appendChild(script);

}

include("js/cookies.js");
include("js/bug_animation.js");
include("js/prompt.js");


