<?php 
$product = null;
    if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $categories = array();
    require_once "./config.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql="select * from loai";
     $re=$pdo->query($sql);
     $data=$re->fetchAll(PDO::FETCH_ASSOC);
     foreach ($data as $key => $value){
        $categories[$value['maloai']] = $value['tenloai'];
     }
     $sql = "SELECT * FROM sanpham WHERE masp = '$productId'";
     $re=$pdo->query($sql);
     $data=$re->fetchAll(PDO::FETCH_ASSOC);
     foreach ($data as $key => $value){
         $product = $value;
     }
 }?>
<div class="w-full">
    <form method="post" action="./xuLy/editProduct.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="product_id">Mã sản phẩm:</label> <br>
            <p><?php echo $product['masp'];?></p>
            <input type="hidden" name="product_id" value="<?php echo $product['masp'];?>">
        </div>
        <div class="w-1/12 p-2">
            <label for="product_name">Tên sản phẩm:</label> <br>
            <input class="w-full" type="text" name="product_name" value="<?php echo $product['tensp'];?>" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="product_price">Giá:</label> <br>
            <input class="w-full" type="number" name="product_price" value="<?php echo $product['gia'];?>" required>
        </div>
        <div class="w-3/12 p-2">
            <label for="product_description">Mô tả:</label> <br>
            <textarea class="w-full" name="product_description"><?php echo $product['mota'];?></textarea>
        </div>
        <div class='w-2/12 p-2'>
            <label for="product_image">Ảnh (URL):</label> <br>
            <img src="<?php echo "./images/upload/{$product['hinh']}"; ?>" alt="Current Image" class="w-16 h-16 mb-2">
            <input class="w-full" type="file" name="product_image" accept="image/*" >
        </div>
        <div class="w-1/12 p-2">
            <label for="product_category">Mã loại:</label> <br>
            <select class="p-2" name="product_category" required>
                <?php
                foreach ($categories as $key => $value) {
                    $selected = ($key == $product['maloai']) ? 'selected' : '';
                    echo "<option class='p-2' value='$key' $selected>$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="w-3/12 p-2 flex items-center justify-center">
            <button type="submit" class="p-2 bg-green-600 text-white">Update Product</button>
        </div>
    </form>
</div>
