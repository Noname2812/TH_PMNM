
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foods</title>
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/food.css">
    <link rel="stylesheet" href="styles/reponsive.css">
</head>
<body>
    <?php 
    require_once "./components/cartNav.php";
    require_once "./components/header.php";
    ?>
    <section>
        <div class="container">
            <form id="sortForm" action='foods.php' method='post'>
                <div class="flex">
                    <div class="relative" id="find-foods">
                        <input type="text" placeholder="I'm looking for..." name="keySearch" value = <?php echo $keySearch; ?>>
                        <button class="absolute" type="submit">Search</button>
                    </div>
                    <div>
                        <select name="sortItems" id="sort" style='padding:10px;' onchange="submitForm()">
                            <option value="default" <?php echo ($choice == 'default') ? 'selected' : ''; ?>>Default</option>
                            <option value="a-z" <?php echo ($choice == 'a-z') ? 'selected' : ''; ?>>A-Z</option>
                            <option value="z-a" <?php echo ($choice == 'z-a') ? 'selected' : ''; ?>>Z-A</option>
                            <option value="desc" <?php echo ($choice == 'desc') ? 'selected' : ''; ?>>High price</option>
                            <option value="asc" <?php echo ($choice == 'asc') ? 'selected' : ''; ?>>Low price</option>
                        </select>
                    </div>
                </div>
            </form>
            <?php
                if(count($data) < 1 ){
                    echo "<h1 style='color:red;margin-top:10px;'>Không tìm thấy sản phẩm phù hợp</h1>";
                }
                else {
                    for($i=0;$i<$totalPage;$i++){
                        $productsPage = array();
                        if($i >0){
                            echo "<div id='page-", $i + 1,"' class='flexNoSpace main-menu-foods hidden'>";
                        }
                        else{
                            echo "<div id='page-", $i + 1,"' class='flexNoSpace main-menu-foods'>";
                        }
                            $productsPage = array_chunk($products,12);
                           foreach($productsPage[$i] as $key => $value){
                            echo "<div>";
                                echo "<div class='item-sells'>";
                                    echo "<img src='./images/upload/{$value['hinh']}' alt=''/>";
                                    echo "<div class='flex' style='padding:10px;'>";
                                    echo "<h4>{$value['tensp']}</h4>";
                                    echo "<span>{$value['gia']}$</span>";
                                    echo "</div>";
                                    echo "<div>";
                                    echo "<form action='./xuLy/addToCart.php' method='post'>";
                                    echo "<button onclick='addCart()' name='addToCart' >Add to cart</button>";
                                    echo "<input type='hidden' name='masp' value='{$value['masp']}'/>";
                                    echo "<input type='hidden' name='tensp' value='{$value['tensp']}'/>";
                                    echo "<input type='hidden' name='gia' value='{$value['gia']}'/>";
                                    echo "<input type='hidden' name='hinh' value='{$value['hinh']}'/>";
                                    echo "</form>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                           }
                        echo "</div>";
                    }
                }
             ?>
        </div>
    </div>
        <div class="container">
            <ul id="controls"  <?php  if(count($data) < 1 ){
                    echo "style='display: none;'";
                }?>>
                <li  id="btnPre">Pre</li>
                <?php
                    for($i=0;$i<$totalPage;$i++){
                        echo "<li class='showPage'>", $i + 1, "</li>";
                    }
                 ?>
                <li  id="btnNext">Next</li>
            </ul>
        </div>
    </section>
    <?php
    include "./components/footer.php"; ?>
</body>
<script>
    function submitForm() {
  document.getElementById("sortForm").submit();
}
</script>
<script src="./cart.js"></script>
<script src="./food.js"></script>
</html>