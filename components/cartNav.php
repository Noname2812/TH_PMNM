<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $itemsCart = array(); 
    function totalPrice($arr){
      $sum = 0;
      if(isset($arr) && count($arr) > 0){
        foreach($arr as $value){
          $sum+=$value['quantity']*$value['price'];
     }
      }
      return $sum;
    }
?>
<div class="relatetive hidden" id="cartContainer">
      <div class="absolute" id="cart-items" style='minHeight:100%;'>
        <div>
          <button onclick="closeCart()" id="closeCart">X</button>
        </div>
        <div style='margin-top: 10px;'>
        <?php 
          if (isset($_SESSION['cart']) && count($_SESSION['cart'])>0) {
            $itemsCart = $_SESSION['cart'];
            foreach($itemsCart as $val){
              echo "<div style='padding: 20px; border-bottom: 1px solid black;' class='cart-item flex'>";
              echo "<img src='./images/upload/{$val['image']}' alt='' with='80' height='80' />";
              echo "<div>";
              echo "<h2>{$val['name']}</h2>";
              echo "<p>Giá: {$val['price']} $</p>";
              echo "<p>Số lượng: {$val['quantity']}</p>";
              echo "</div>";
              echo "</div>";
            }
         }
         else{
          echo "<div>Cart is Emty !</div>";
        }
        ?>
        </div>
        <div class="flex">
          <div>
            <p>Subtotal : <span><?php echo totalPrice($itemsCart)." $";?></span></p>
          </div>
          <div>
            <button id="check-out-cart"><a href="./cart.php">Checkout</a></button>
          </div>
        </div>
      </div>
</div>