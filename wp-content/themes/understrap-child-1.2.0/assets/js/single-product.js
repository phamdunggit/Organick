//zoom product image
let zoom = document.querySelector(".single-product-image");
let imgZoom = document.querySelector("#img-zoom");
// console.log("hello");
zoom.addEventListener("mousemove", (event) => {
  imgZoom.style.opacity = 1;
  let positionPx = event.x - zoom.getBoundingClientRect().left;
  let positionX = (positionPx / zoom.offsetWidth) * 100;
  let positionPy = event.y - zoom.getBoundingClientRect().top;
  let positionY = (positionPy / zoom.offsetHeight) * 100;
  imgZoom.style.setProperty("--zoom-x", positionX + "%");
  imgZoom.style.setProperty("--zoom-y", positionY + "%");
  let transformX = -(positionX - 50) / 3.5;
  let transformY = -(positionY - 50) / 3.5;
  imgZoom.style.transform = `scale(1.3) translateX(${transformX}%) translateY(${transformY}%)`;
});
zoom.addEventListener("mouseout", () => {
  imgZoom.style.opacity = 0;
});

// toggle  class list description-btn between additional-btn
let description_btn = document.querySelector(".description-btn");
let additional_btn = document.querySelector(".additional-btn");
let product_description = document.querySelector(".product-description");
let additional_info = document.querySelector(".additional-info");
description_btn.addEventListener("click", () => {
  additional_btn.classList.remove("active");
  description_btn.classList.add("active");
  product_description.classList.add("show");
  additional_info.classList.remove("show");
});
additional_btn.addEventListener("click", () => {
  description_btn.classList.remove("active");
  additional_btn.classList.add("active");
  additional_info.classList.add("show");
  product_description.classList.remove("show");
});