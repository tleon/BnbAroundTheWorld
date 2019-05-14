function scrollAppear1() {
    var block1 = document.querySelector(".blocktext-1");
    var block2 = document.querySelector(".blocktext-2");
    var block3 = document.querySelector(".blocktext-3");
    var block4 = document.querySelector(".blocktext-4");
    var block5 = document.querySelector(".blocktext-5");
    
    var PositionBlock1 = block1.getBoundingClientRect().top;
    var PositionBlock2 = block2.getBoundingClientRect().top;
    var PositionBlock3 = block3.getBoundingClientRect().top;
    var PositionBlock4 = block4.getBoundingClientRect().top;
    var PositionBlock5 = block5.getBoundingClientRect().top;
    
    var screenPosition = window.innerHeight / 1.55;
    
    if (PositionBlock1 < screenPosition) {
        block1.classList.add("appear");
    }
    if (PositionBlock2 < screenPosition) {
        block2.classList.add("appear");
    }
    if (PositionBlock3 < screenPosition) {
        block3.classList.add("appear");
    }
    if (PositionBlock4 < screenPosition) {
        block4.classList.add("appear");
    }
    if (PositionBlock5 < screenPosition) {
        block5.classList.add("appear");
    }
}
    
    window.addEventListener("scroll", scrollAppear1);

// Change a links color
document.addEventListener("scroll", changecolorOfNavLinks);
const targt = document.getElementById('notreGite');
const nav = document.getElementById("nav");
let nav_a = nav.querySelectorAll('a');

function changecolorOfNavLinks() {
  if (targt.getBoundingClientRect().top < 0) {
    for(let i = 0; i < nav_a.length; i++){
      nav_a[i].className = 'nav_a_link_black';
    }
    document.getElementById('nav').classList.remove("bgTranparent");
    document.getElementById('nav').classList.add("bgWhite");
  } else {
    for(let i = 0; i < nav_a.length; i++){
    nav_a[i].className = 'nav_a_link_white';
    }
    document.getElementById('nav').classList.remove("bgWhite");
    document.getElementById('nav').classList.add("bgTranparent");
  }
}
    