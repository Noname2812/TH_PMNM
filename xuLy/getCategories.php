<div class="w-full">
<h1 class='text-center text-2xl text-blue-600 pb-8'>List Categories </h1>
<div class="w-full">
<form method="post" action="./xuLy/addCategory.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="category_id">Mã loai:</label> <br>
            <input class="w-full" type="text" name="category_id" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="category_name">Tên loai:</label> <br>
            <input class="w-full" type="text" name="category_name" required>
        </div>
        <div class="w-2/12 p-2">
            <label for="category_image">Ảnh</label> <br>
            <input class="w-full" type="file" name="category_image" required>
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
            <th class='py-2 px-2 border-r border-b w-1/12'>Mã loại</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Tên loại</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Số lượng</th>
           <th class='py-2 px-2 border-r border-b w-2/12'>Ảnh</th>
            <th class='py-2 px-2 border-b w-3/12'></th>
    </tr>
</thead>
<tbody>
<?php
try {
    require_once "./config.php";
    require_once "./utils.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="select * from loai";
    $re=$pdo->query($sql);
    $data=$re->fetchAll(PDO::FETCH_ASSOC);
    $sql ="";
    foreach ($data as $key => $value) {
        $sql = "select * from sanpham where maloai='{$value['maloai']}'";
        $re=$pdo->query($sql);
        $data=$re->fetchAll(PDO::FETCH_ASSOC);
        $count =  count($data);
        echo "<tr class='border-b'>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['maloai']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['tenloai']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>$count</td>";
        echo "<td class='py-2 px-2 border-r '><img src='./images/upload/{$value['image']}' class='h-8 w-8 mx-auto' alt='{$value['tenloai']}' /></td>";
        echo "<td class='py-2 px-2 border-b text-center flex gap-8 justify-center'>";
        echo "<form action='./xuLy/deleteCategory.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-red-600 rounded text-white' name='delete_category'>";
        echo "Delete";
        echo "</button>";
        echo "<input type='hidden' name='category_id' value='{$value['maloai']}'/>";
        echo "</form>";
        echo "<form action='dashboard.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-blue-600 rounded text-white'>Update</button>";
        echo "<input type='hidden' name='update_category_id' value='{$value['maloai']}'/>";
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