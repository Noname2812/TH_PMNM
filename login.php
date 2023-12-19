<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] != null) {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
        header("Location: ./dashboard.php");
        exit;
    } 
    else {
        header("Location: ./index.php");
        exit;
    }
}
 ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles/home.css" />
    <link rel="stylesheet" href="styles/login.css" />
    <link rel="stylesheet" href="reponsive.css" />
    <link rel="stylesheet" href="reponsiveLogin.css" />
  </head>
  <body>
  <?php 
    include "./components/cartNav.php";
    ?>
    <header>
      <div class="container flex">
        <div class="res-logo">
          <a href="./index.php"
            ><img src="./images/res-logo.png" alt="res-logo"
          /></a>
          <a href="./index.php">
            <h5>Tasty Treat</h5>
          </a>
        </div>
        <div class="flex menu">
          <a href="./index.php">Home</a>
          <a href="./Foods.php">Foods</a>
          <a href="./cart.php">Cart</a>
        </div>
        <div class="flex relative" id="menu-left">
          <div>
            <a onclick="openCart()" id="cartOpen" href="#"
              ><img src="./images/icons/icons8-shopping-cart-24.png" alt=""
            /></a>
            <span class="absolute count-items">0</span>
          </div>
          <div>
            <a href="#"
              ><img src="./images/icons/icons8-account-48.png" alt=""
            /></a>
          </div>
        </div>
      </div>
    </header>
    <section style="overflow-y: hidden">
      <div class="container">
        <div>
          <form action="./xuLy/login.php" id="login" method="post">
            <div><img src="./images/icons/icons8-account-48.png" alt="" /></div>
            <h3>You want wanna join ?</h3>
            <input
              class="input"
              type="text"
              name="username"
              placeholder="Username"
            />
            <br />
            <input
              class="input"
              type="password"
              name="password"
              placeholder="Password"
            />
            <br />
            <p class="hidden" style="color: red">Sai mật khẩu !</p>
            <br />
            <div class="flex">
              <label>
                <input type="checkbox" />
                Remember me
              </label>
              <a onclick="forgot()" href="#">Forgot Password</a>
            </div>
            <button type="submit">Login</button>
          </form>
          <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;">Sai tên đăng nhập hoặc mật khẩu!</p>';
    }
    if (isset($_GET['error']) && $_GET['error'] == 2) {
      echo '<p style="color: red;">Create account fail ! Passwords do not match !</p>';
  }
  if (isset($_GET['error']) && $_GET['error'] == 3) {
    echo '<p style="color: green;">Create account success !</p>';
}
if (isset($_GET['error']) && $_GET['error'] == 4) {
  echo '<p style="color: red;">User name account already !</p>';
}
    ?>
          <form id="forgotPass" class="hidden">
            <div><img src="./images/icons/icons8-account-48.png" alt="" /></div>
            <h3>Forgot password</h3>
            <input
              class="input"
              type="text"
              placeholder="Your mail or your phone"
            />
            <br />
            <input class="input" type="text" placeholder="Enter code" />
            <button type="submit" onclick="creatNewPass()">Submit</button>
          </form>
          <form action="./xuLy/createUser.php" id="createAncount" class="hidden" method="post">
            <h3>Create an ancount</h3>
            <input
              class="input"
              type="text"
              name="username"
              placeholder="Username"
              require
            />
            <br />
            <input
              class="input"
              type="password"
              name="password"
              placeholder="Password"
              require
            />
            <br />
            <input class="input" type="password" placeholder="Confirm Password" name="confirmPassword"/>
            <br />
            <input
              class="input"
              type="text"
              name="mail"
              placeholder="Your mail"
              require
            />
            <br />
            <button type="submit">Create</button>
          </form>
          <form action="#" id="re-enterNewPassword" class="hidden">
            <div><img src="./images/icons/icons8-account-48.png" alt="" /></div>
            <h3>Forgot password</h3>
            <input class="input" type="text" placeholder="password" />
            <br />
            <input class="input" type="text" placeholder="Confirm Password" />
            <button type="submit" onclick="login()">Submit</button>
          </form>
          <a onclick="createAncount()" class="choice" href="#"
            >Don't have an account? Create an account</a
          >
          <a class="choice hidden" href="./login.php"
            >Are you have an ancount? Login now !</a
          >
        </div>
      </div>
    </section> 
     <?php
    include "./components/footer.php"; ?>
  </body>
  <script src="./login.js"></script>
</html>
