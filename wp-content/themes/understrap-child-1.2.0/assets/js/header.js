let toggler = document.querySelector(".navbar-toggler");
let menu = document.querySelector("#bs-example-navbar-collapse-1");
toggler.addEventListener("click", function () {
  menu.classList.toggle("show");
});




window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});