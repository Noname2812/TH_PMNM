<?php
function addToCart($id, $name, $price, $image) {
    $product = array(
        'id'    => $id,
        'name'  => $name,
        'price' => $price,
        'image' => $image
    );
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
        $product['quantity'] = 1;
        array_push($_SESSION['cart'],$product);
        $_SESSION['count'] = 1;
    }
    else {
        $productExists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] += 1;
                $_SESSION['count']++;
                $productExists = true;
                break;
            }
        }
        if (!$productExists) {
            $product['quantity'] = 1;
            array_push($_SESSION['cart'],$product);
            $_SESSION['count']++;
        }
    }
  
}
function subtotalCart(){
    $sum = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $value){
            $sum+=$value['quantity']*$value['price'];
        }
    }
    return $sum;
}
function updateCart($quantity, $id){
    if(isset($_SESSION['cart']) && isset($quantity) && isset($id)){
        $cart = $_SESSION['cart'];
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
        $_SESSION['cart'] = $cart;
        $_SESSION['count'] = getQuantity();
        header("Location: cart.php");
        exit;
    }
}
function getQuantity(){
    $quantity = 0;
    if(isset($_SESSION['cart']))
    {
        $cart = $_SESSION['cart'];
        foreach ($cart as  $item){
            $quantity+=$item['quantity'];
        }

    }
    return $quantity;
}
function deleteItemInCart($id){
    if(isset($_SESSION['cart']) && isset($id)){
        $cart = $_SESSION['cart'];
        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                $_SESSION['count'] -= $item['quantity'];
                unset($cart[$key]);
                break;
            }
        }
        $cart = array_values($cart);
        $_SESSION['cart'] = $cart;  
        header("Location: cart.php");
        exit;
    }
}
function countProducts($id){
    $sql = "select count(masp) from sanpham where maloai=$id";
    $re=$pdo->query($sql);
    $data=$re->fetchAll(PDO::FETCH_ASSOC);
    return count($data);
}
?>
