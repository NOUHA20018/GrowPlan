document.querySelector(".jsFilter").addEventListener("click", function () {
   document.querySelector(".filter-menu").classList.toggle("active");
 });
 
 document.querySelector(".grid").addEventListener("click", function () {
   document.querySelector(".list").classList.remove("active");
   document.querySelector(".grid").classList.add("active");
   document.querySelector(".products-area-wrapper").classList.add("gridView");
   document
     .querySelector(".products-area-wrapper")
     .classList.remove("tableView");
 });
 
 document.querySelector(".list").addEventListener("click", function () {
   document.querySelector(".list").classList.add("active");
   document.querySelector(".grid").classList.remove("active");
   document.querySelector(".products-area-wrapper").classList.remove("gridView");
   document.querySelector(".products-area-wrapper").classList.add("tableView");
 });
 
 var modeSwitch = document.querySelector('.mode-switch');
 modeSwitch.addEventListener('click', function () {            
    document.documentElement.classList.toggle('light');
  modeSwitch.classList.toggle('active');
 });

//  welcome
// Effet d'apparition lors du scroll
document.addEventListener("DOMContentLoaded", function () {
    const aboutSection = document.querySelector("#about");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("fade-in");
            }
        });
    }, { threshold: 0.2 });

    observer.observe(aboutSection);
});
