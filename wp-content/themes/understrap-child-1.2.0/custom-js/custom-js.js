let menu= document.getElementById("menu")
let navbar=document.querySelector(".menu");
menu?.addEventListener("click",function(){
    navbar.classList.toggle("active");
});
window.onscroll=()=>{
    navbar.classList.remove("active");
}