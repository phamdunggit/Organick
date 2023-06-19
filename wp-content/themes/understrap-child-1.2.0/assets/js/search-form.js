const search_input = document.getElementById("search-input");
const search_submit = document.getElementById("search-submit");

search_input.addEventListener("input", function() {
  if (search_input.value.trim().length === 0) {
    search_submit.disabled = true;
  } else {
    search_submit.disabled = false;
  }
});

const xhr = new XMLHttpRequest();
let typingTimer;
const doneTypingInterval = 500;
search_input.addEventListener("focus",function(){
  document.getElementById("search-list").style.display="block";
})
search_input.addEventListener("blur",function(){
    setTimeout(function(){document.getElementById("search-list").style.display="none";},300)
    
});
search_input.addEventListener("keyup", function() {
  clearTimeout(typingTimer);
  const searchText = this.value;
  if (String(searchText) != '' ) {
    document.getElementById("search-list").innerHTML = `
      <li>
        <div class="loading">
          <img src="https://miro.medium.com/v2/resize:fit:1400/1*CsJ05WEGfunYMLGfsT2sXA.gif" alt="">
        </div>
      </li>
    `;
    typingTimer = setTimeout(function(){doneTyping(searchText)}, doneTypingInterval);
  } else {
    document.getElementById("search-list").innerHTML = "";
  }
});

function doneTyping(searchText) {
  // console.log(searchText);
  xhr.open('GET', `http://organick.local/wp-admin/admin-ajax.php?action=get_ajax_posts&s=${searchText}`);
  xhr.onload = function() {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      document.getElementById("search-list").innerHTML = "";
      console.log(response);
      if (Object.keys(response).length != 0) {
        let html = "";
        response.forEach(function(product) {
          if (product.sale_price=="") {
            html += `
            <li>
              <a href="${product.slug}">
              <div class="search-result">
                <div class="result-product-image">
                  <img src="${product.image_url}" alt="">
                </div>
                <div class="result-product-info">
                  <h6 class="search-product-name">${product.name}</h6>
                  <span class="sale-price">${product.currency_symbol}${product.regular_price}</span>
                </div>
              </div>
              </a>
            </li>
          `;
          } else {
            html += `
            <li>
              <a href="${product.slug}">
              <div class="search-result">
                <div class="result-product-image">
                  <img src="${product.image_url}" alt="">
                </div>
                <div class="result-product-info">
                  <h6 class="search-product-name">${product.name}</h6>
                  <span class="origin-price">${product.currency_symbol}${product.regular_price}</span>
                  <span class="sale-price">${product.currency_symbol}${product.sale_price}</span>
                </div>
              </div>
              </a>
            </li>
          `;
          }
        });

        document.getElementById("search-list").innerHTML = html;
      } else {
        document.getElementById("search-list").innerHTML = `
          <li class="no-result-found">
            <h6 >No result</h6>
          </li>
        `;
      }
    } else {
      console.error(xhr.statusText);
    }
  };
  xhr.send();
}