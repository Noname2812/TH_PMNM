
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../config.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_image = ""; 
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    if (isset($_FILES["product_image"])) {
        $image = $_FILES["product_image"];
        $imageName = $image["name"];
        $imageTmpName = $image["tmp_name"];
        $imageSize = $image["size"];
        $imageError = $image["error"];
        $imageType = $image["type"];
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (in_array($imageExt, $allowedTypes)) {
            $newImageName = uniqid("image_") . "." . $imageExt;
            $uploadImagePath = "../images/upload/" . $newImageName;
            move_uploaded_file($imageTmpName, $uploadImagePath);
            $product_image = $newImageName;
        }
    }
    if($product_image == "")  {
        $updateSql = "UPDATE sanpham SET tensp = '$product_name', gia = '$product_price', mota='$product_description', maloai = '$product_category'  WHERE masp = '$product_id'";
    }
    else{
        $updateSql = "UPDATE sanpham SET tensp = '$product_name', gia = '$product_price', mota='$product_description', hinh='$product_image',maloai = '$product_category' WHERE masp = '$product_id'";
    }
    if ($conn->query($updateSql) === TRUE) {
        header("Location: ../dashboard.php?page=products");
        exit();
    } else {
        header("Location: ../dashboard.php?page=products&error=1");
        exit();
    }
}
?>