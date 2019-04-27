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


// function bigSize() {
//   document.getElementById("contact_footer_mail").style.width = '500px';
//   document.getElementById("contact_footer_text").style.width = '500px';
//   document.getElementById("contact_footer_text").style.height = '200px';
// }
