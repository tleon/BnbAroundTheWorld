const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener("click", () => {
  navLinks.classList.toggle("open");
  links.forEach(link => {
    link.classList.toggle("fade");
  });
});

let url = document.URL ;
if(url == "http://localhost:8000/"){
  let node = document.getElementsByClassName('nav-links');
}

let spiltUrl = url.split('/');
let checkUrl = spiltUrl.includes("Room")
if(checkUrl) {
  for(let i = 0; i < document.getElementById("navUl").querySelectorAll('a').length; i++){
    document.getElementById("navUl").querySelectorAll('a')[i].className = 'nav_a_link_black';
  }
  
};
