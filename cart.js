var cartItems = document.getElementById("cart-items");
var cartContainer = document.getElementById("cartContainer");
function openCart() {
  cartItems.style.right = "0";
  cartContainer.classList.remove("hidden");
}

function closeCart() {
  cartItems.style.right = "100%";
  cartContainer.classList.add("hidden");
}
// Cart
// var btnCheckout = document.getElementById("checkout");
// function showCart() {
//   let check = true;
//   let pageCheckBill = document.getElementById("page-checkout");
//   let pageIsEmty = document.getElementById("isEmty");
//   if (check) {
//     pageIsEmty.style.display = "none";
//     pageCheckBill.style.display = "block";
//     check = !check;
//   }
// }
// var countItems = 0;
// var spanCountItems = document.querySelectorAll("span.count-items");
// var arraySpanCountItems = [...spanCountItems];
// function showIndexAddCart() {
//   for (let i = 0; i < arraySpanCountItems.length; i++) {
//     arraySpanCountItems[i].textContent = countItems;
//   }
// }
// function addCart() {
//   countItems++;
//   showIndexAddCart();
// }
