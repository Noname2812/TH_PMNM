// home 
// cart items
var cartItems = document.getElementById("cart-items")
var cartContainer = document.getElementById("cartContainer")
function openCart() {
    cartItems.style.right="0"
    cartContainer.classList.remove("hidden")
}

function closeCart() {
    cartItems.style.right="100%"
    cartContainer.classList.add("hidden")
}
// ------------
function playMusic(){
    let myAudio=document.getElementById('playAudio');
    if(myAudio.duration>0&&!myAudio.paused){}
    else{myAudio.play()}
}
var listItems = document.getElementsByClassName("sticks-item")
console.log(listItems.length);
var arrayItems = [...listItems]
for(let k=0;k<listItems.length;k++)
{
    arrayItems[k].addEventListener('mouseover',function(){
        clearInterval(t)
    })
    arrayItems[k].addEventListener('mouseout',function(){
        t = setInterval(function(){
            sticksList.style.transform ="translate3d("+posittion+"px,0,0)";
            posittion=posittion-546
            if(posittion==-2184){
                posittion=0
                sticksList.style.transform ="translate3d("+posittion+"px,0,0)";
            }
        },4000)
    })
}
var sticksList = document.getElementById("sticks-list")
var t;
var checkSizePosition =document.getElementsByClassName("persons")[0].offsetWidth
console.log(checkSizePosition);
var posittion = 0 - checkSizePosition
t = setInterval(function(){
    sticksList.style.transform ="translate3d("+posittion+"px,0,0)";
    posittion=posittion-checkSizePosition
    if(posittion==-(checkSizePosition*4)){
        posittion=0
        sticksList.style.transform ="translate3d("+posittion+"px,0,0)";
    }
},4000)


