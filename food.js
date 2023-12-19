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
//
var btnNext = document.getElementById("btnNext");
var btnPre = document.getElementById("btnPre");
var count = 1;
var arrayShowPage = document.querySelectorAll(".showPage");
var arrayListShow = [...arrayShowPage];
arrayListShow[0].style.backgroundColor = "red";
for (let i = 0; i < arrayListShow.length; i++) {
  arrayListShow[i].addEventListener("click", function () {
    addClassHidden();
    let showPageNow = document.getElementById("page-" + (i + 1));
    count = i + 1;
    showPageNow.classList.remove("hidden");
    arrayListShow[i].style.backgroundColor = "red";
  });
}
function addClassHidden() {
  for (let i = 0; i < arrayListShow.length; i++) {
    let showPage = document.getElementById("page-" + (i + 1));
    showPage.classList.add("hidden");
    arrayListShow[i].style.backgroundColor = "#212245";
  }
}
btnNext.addEventListener("click", function () {
  addClassHidden();
  count = count + 1;
  if (count > arrayListShow.length) {
    count = count - 1;
  }
  let showPageNow = document.getElementById("page-" + count);
  showPageNow.classList.remove("hidden");
  arrayListShow[count - 1].style.backgroundColor = "red";
});
btnPre.addEventListener("click", function () {
  addClassHidden();
  count = count - 1;
  if (count < 1) {
    count = 1;
  }
  let showPageNow = document.getElementById("page-" + count);
  showPageNow.classList.remove("hidden");
  arrayListShow[count - 1].style.backgroundColor = "red";
});
