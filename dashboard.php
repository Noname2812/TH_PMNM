<?php
session_start();
$page ="categories";
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} 
if(isset($_REQUEST['logout'])){
  $_SESSION["admin"] = null;
  $_SESSION["username"] = null;
  header("Location: ./login.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update_product_id'])) {
    $ma = $_POST['update_product_id'];
    header("Location: dashboard.php?page=updateProduct&id=$ma");
    exit();
  }
  if (isset($_POST['update_user_id'])) {
    $ma = $_POST['update_user_id'];
    header("Location: dashboard.php?page=updateUser&id=$ma");
    exit();
  }
  if (isset($_POST['update_category_id'])) {
    $ma = $_POST['update_category_id'];
    header("Location: dashboard.php?page=updateCategory&id=$ma");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Your Dashboard</title>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen bg-gray-200">
    <aside class="w-64 bg-gray-800">
      <div class="p-4 text-white">
        <h1 class="text-2xl font-semibold">Dashboard</h1>
      </div>
      <nav class="mt-4">
      <form action='dashboard.php' method='post'>
      <button   class="w-full py-2 px-2 text-gray-200 hover:bg-gray-700 nav-button <?php if($page == "categories") echo "bg-gray-700" ?>"  >Categories</button>
      <input type='hidden' name='page' value='categories'/>
      </form>
      <form action='dashboard.php' method='post'>
      <button   class="w-full py-2 px-2 text-gray-200 hover:bg-gray-700 nav-button  <?php if($page == "products") echo "bg-gray-700" ?>"  >Products</button>
      <input type='hidden' name='page' value='products'/>
      </form>
      <form action='dashboard.php' method='post'>
      <button   class="w-full py-2 px-2 text-gray-200 hover:bg-gray-700 nav-button <?php if($page == "users") echo "bg-gray-700" ?>"  >Users</button>
      <input type='hidden' name='page' value='users'/>
      </form>
      </nav>
    </aside>
    <div class="flex-1 flex flex-col overflow-hidden">
      <header class="bg-white shadow">
        <div class="flex text-center justify-between p-4 border-b">
          <div class="pl-16">
            <h2 class="text-xl font-semibold">Welcome <?php if(isset($_SESSION['admin'])) {echo $_SESSION['admin'];}?></h2>
          </div>
          <form action='dashboard.php' method='post'>
          <input type='hidden' name='logout' value='logout'/>
            <button type="submit" class="text-gray-500 p-4 focus:outline-none">
              <img class="w-8 h-8" src="https://as2.ftcdn.net/v2/jpg/00/30/49/15/1000_F_30491549_XpEdNEd4soF2bV8z95CuCSkTwxMySP9p.jpg" alt="ic_logout">
              logout
            </button>
          </form>
        </div>
      </header>
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto p-6 flex items-center justify-center" id="dashboardContent">
        <?php 
        if(isset($_SESSION["admin"])){
          switch($page){
            case "products": 
              include "./xuLy/getProducts.php";
              break;
            case "categories":
              include "./xuLy/getCategories.php";
              break;
            case "users":
              include "./xuLy/getUsers.php";
              break;
            case "updateProduct":
              require "./components/updateProduct.php";
              break;
              case "updateUser":
                require "./components/updateUser.php";
                break;
                case "updateCategory":
                  require "./components/updateCategory.php";
                  break;
          }
        }
        else{
          header("Location: ./login.php");
          exit();
        }
        ?>
        </div>
      </main>
    </div>
  </div>
</body>
</html>
