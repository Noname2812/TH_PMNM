<?php
session_start();
if(isset($_POST['masp']) && $_POST['tensp'] && $_POST['gia'] && $_POST['hinh']){
    require "../utils.php";
    if(isset($_SESSION['username']) && $_SESSION['username'] !=""){
      addToCart($_POST['masp'], $_POST['tensp'] , $_POST['gia'] , $_POST['hinh']);
      header("Location: ../foods.php");
      exit();
    }
    else{
      header("Location: ../login.php");
      exit();
    }
}
?>