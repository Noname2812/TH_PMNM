<?php
 session_start();
 $checkout=0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_item_update']) && isset($_POST['quantity'])) {
        include_once "./utils.php";
        $id = $_POST['id_item_update'];
        $quantity = $_POST['quantity'];
        if($quantity > 99){
            $quantity = 99;
        }
        if($quantity > 0){
            updateCart($quantity,$id);
        }
    } elseif (isset($_POST['id_item_delete'])) {
        include_once "./utils.php";
        $id = $_POST['id_item_delete'];
        deleteItemInCart($id);
    }
}
if(isset($_GET['checkout'])){
    $checkout = $_GET['checkout'];
}
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foods</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/food.css">
    <link rel="stylesheet" href="styles/cart.css">
</head>
<body>
    <?php 
        include "./components/cartNav.php";
        include "./components/header.php";
    ?>
    <section style="<?php if($checkout == 1 || $checkout ==2) echo "display:none;";?>">
        <div class="container">
            <table id="table-cart" class=<?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) echo "hidden"?>>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            foreach($_SESSION['cart'] as $value){
                                echo "<tr>";
                                echo "<th><img src='./images/upload/{$value['image']}'></th>";
                                echo "<th>{$value['name']}</th>";
                                echo "<th>{$value['price']} $</th>";
                                echo "<th style='with:100px;'>
                                <form action = 'cart.php' method='post' id='{$value['id']}'>
                                <input type='number' name='quantity' value='{$value['quantity']}' onchange='submitForm('{$value['name']}')'/>
                                <input type='hidden' name='id_item_update' value='{$value['id']}'/>
                                </form>
                                </th>";
                                echo "<th style='with:100px;'>
                                <form action='cart.php' method='post'>
                                <button type='submit'><img src='./images/icons/delete.png'></button>
                                <input type='hidden' name='id_item_delete' value='{$value['id']}'/>
                                </form>
                                </th>";
                                echo "</tr>";
                            }   
                        }
                    ?>
                </tbody>
            </table>
            <?php 
             if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1){
                echo "  <h2>Your cart is empty</h2>";
             }
             ?>
            <h3>Subtotal: <span class="sum-money"><?php
                require_once "./utils.php";
                echo subtotalCart(). " $";
             ?></span></h3>
            <p>Taxes and shipping will caculator at checkout</p>
            <button style='padding:10px;'><a href="./foods.php">Continue Shopping</a></button>
            <button style ='padding:10px;' id="checkout">
            <a href="./cart.php?checkout=1">Proceed to checkout</a>
            </button>
        </div>
    </section>
    <section id="page-checkout" style=" <?php if($checkout == 1) echo "display:block;";?>">
        <div class="container flex">
            <form action="./xuLy/createOrder.php" method="post">
                <h4>Shipping Address</h4>
                <input type="text" placeholder="Enter your name" name="name">
                <input type="number" placeholder="Phone number" name="phone">
                <input type="text" placeholder="Your address" name="address">
                <input type="hidden" name="username" value="<?php echo $_SESSION["username"];?>" />
                <button type="submit">Payment</button>
            </form>
            <div id="checkout-bill">
                <h6 class="flex">Subtotal: $
                    <span class="sum-money"><?php include_once "./utils.php"; echo subtotalCart(). "$"; ?></span>
                </h6>
                <h6 class="flex">Shipping: $
                    <span>30</span>
                </h6>
                <hr>
                <h4 class="flex">Total: 
                    <span>$<?php include_once "./utils.php"; $total = subtotalCart() + 30; echo $total.""; ?></span>
                </h4>
            </div>
        </div>
    </section>
    <div>
     <?php if($checkout == 2){
        include_once "./components/orderDetail.php";
     }
        ?>"
     </div>
    <?php
    include "./components/footer.php"; ?>
</body>
<script src="./cart.js"></script>
<script>
    function submitForm(id) {
  document.getElementById(id).submit();
}
</script>
</html>