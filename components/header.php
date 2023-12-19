<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(isset($_REQUEST['logout'])){
        $_SESSION["username"] = null;
        $_SESSION["cart"] = null;
        $_SESSION['count'] = 0;
        header("Location: ../login.php");
        exit();
      }
?>
<header>
    <div class="container flex">
        <div class="res-logo">
            <a href="./index.php"><img src="./images/res-logo.png" alt="res-logo"></a>
                <a href="./index.php">
                    <h5>Tasty Treat</h5>
                </a>
        </div>
            <div class="flex menu">
                <a href="./">Home</a>
                <a href="./foods.php">Foods</a>
                <a href="./cart.php">Cart</a>
            </div>
            <div class="flex relative" id="menu-left">
                <div>
                    <a onclick="openCart()" href="#"><img src="./images/icons/icons8-shopping-cart-24.png" alt=""></a>
                    <span class="absolute count-items"><?php
                    if(isset($_SESSION['count'])){
                     echo $_SESSION['count'];
                    }
                    else {
                        echo 0;
                    }
                      ?></span>
                </div>
                <div style = 'margin-left:30px;'>
                    <?php if(isset($_SESSION['username']) && $_SESSION['username'] != "")
                    {
                        echo "
                        <form action='./components/header.php' method='post'>
                        <input type='hidden' name='logout' value='logout'/>
                          <button type='submit'>
                            <img width='80' height = '80' src='https://as2.ftcdn.net/v2/jpg/00/30/49/15/1000_F_30491549_XpEdNEd4soF2bV8z95CuCSkTwxMySP9p.jpg' alt='ic_logout'>
                            logout
                          </button>
                        </form>";
                    }
                    else {
                        echo "<a href='./login.php'><img src='./images/icons/icons8-account-48.png' alt=''></a>";
                    }
                     ?>
            </div>
        </div>
    </div>
</header>
<section id="banner">
    <div class="container">
        <div><h1>All Food</h1></div>
     </div>
</section>