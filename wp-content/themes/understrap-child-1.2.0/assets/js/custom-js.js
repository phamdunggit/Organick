// let menu= document.getElementById("menu")
// let navbar=document.querySelector(".menu");
// menu?.addEventListener("click",function(){
//     navbar.classList.toggle("active");
// });
// window.onscroll=()=>{
//     navbar.classList.remove("active");
// }
let toggler=document.querySelector('.navbar-toggler');
let menu = document.querySelector('#bs-example-navbar-collapse-1');
toggler.addEventListener("click",function(){
    menu.classList.toggle('show');
})