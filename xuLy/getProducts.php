<?php
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
 ?>
<div class="w-full">
<h1 class='text-center text-2xl text-blue-600 pb-8'>Product List</h1>
<div class="w-full">
<form method="post" action="./xuLy/addProduct.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="product_id">Mã sản phẩm:</label> <br>
            <input class="w-full" type="text" name="product_id" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="product_name">Tên sản phẩm:</label> <br>
            <input class="w-full" type="text" name="product_name" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="product_price">Giá:</label> <br>
            <input class="w-full" type="number" name="product_price" required>
        </div>
        <div class="w-3/12 p-2">
            <label for="product_description">Mô tả:</label> <br>
            <textarea  class="w-full" name="product_description" ></textarea>
        </div>
        <div class='w-2/12 p-2'>
            <label for="product_image">Ảnh (URL):</label> <br>
            <input class="w-full" type="file" name="product_image" accept="image/*" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="product_category">Mã loại:</label> <br>
            <select class="p-2" name="product_category" required>
                <?php
                    foreach($categories as $key => $value){
                        echo "<option class='p-2' value='$key'>$value</option>";
                    }
                 ?>
            </select>
        </div>
        <div class="w-3/12 p-2 flex items-center justify-center">
            <button type="submit" class="p-2 bg-green-600 text-white">Add Product</button>
        </div> 
</form>
<?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;">Add fail !</p>';
    }
 ?>
</div>
<table class='min-w-full bg-white border border-gray-300'>
<thead>
     <tr>
            <th class='py-2 px-2 border-r border-b w-1/12'>Mã sản phẩm</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Tên sản phẩm</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Giá</th>
           <th class='py-2 px-2 border-r border-b w-3/12'>Mô tả</th>
           <th class='py-2 px-2 border-r border-b w-2/12'>Ảnh</th>
            <th class='py-2 px-2 border-r border-b w-1/12'>Mã loại</th>
            <th class='py-2 px-2 border-b w-3/12'></th>
    </tr>
</thead>
<tbody>
<?php
try {
    $sql="select * from sanpham";
    $re=$pdo->query($sql);
    $data=$re->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $key => $value) {
        echo "<tr class='border-b'>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['masp']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['tensp']}</td>";
        echo "<td class='py-2 px-2 border-r'>{$value['gia']} $</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['mota']}</td>";
        echo "<td class='py-2 px-2 border-r flex items-center justify-center'><img src='./images/upload/{$value['hinh']}' class='h-8 w-8' alt='{$value['tensp']}' /></td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['maloai']}</td>";
        echo "<td class='py-2 px-2 text-center flex gap-8 justify-center'>";
        echo "<form action='./xuLy/deleteProduct.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-red-600 rounded text-white' name='delete_product'>";
        echo "Delete";
        echo "</button>";
        echo "<input type='hidden' name='delete_product_id' value='{$value['masp']}'/>";
        echo "</form>";  
        echo "<form action='dashboard.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-blue-600 rounded text-white'>Update</button>";
        echo "<input type='hidden' name='update_product_id' value='{$value['masp']}'/>";
        echo "</form>";  
        echo "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
}
?>
</tbody>
</table>
</div>