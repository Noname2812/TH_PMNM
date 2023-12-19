<?php 
$category = null;
    if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categories = array();
    require_once "./config.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "SELECT * FROM loai WHERE maloai = '$categoryId'";
     $re=$pdo->query($sql);
     $data=$re->fetchAll(PDO::FETCH_ASSOC);
     foreach ($data as $key => $value){
         $category = $value;
     }
 }?>
<div class="w-full">
<form method="post" action="./xuLy/editCategory.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="category_id">Mã loai:</label> <br>
            <p><?php echo $category['maloai'];?></p>
            <input type="hidden" name="category_id" value="<?php echo $category['maloai'];?>">
        </div>
        <div class="w-1/12 p-2">
            <label for="category_name">Tên loai:</label> <br>
            <input class="w-full" type="text" name="category_name" value="<?php echo $category['tenloai'];?>" required>
        </div>
        <div class="w-2/12 p-2">
        <label for="category_image">Ảnh (URL):</label> <br>
            <img src="<?php echo "./images/upload/{$category['image']}"; ?>" alt="Current Image" class="w-16 h-16 mb-2">
            <input class="w-full" type="file" name="category_image" accept="image/*" >
        </div>
        <div class="w-3/12 p-2 flex items-center justify-center">
            <button type="submit" class="p-2 bg-green-600 text-white">Update category</button>
        </div> 
</form>
</div>