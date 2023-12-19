<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../config.php";
    try {
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
        $sql = "INSERT INTO sanpham (masp, tensp, gia, mota, hinh, maloai)
                VALUES ('$product_id', '$product_name', '$product_price', '$product_description', '$product_image', '$product_category')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../dashboard.php?page=products");
            exit;
        } else {
            unlink($uploadImagePath);
            header("Location: ../dashboard.php?page=products&error=1");
            exit;
        }
        $conn->close();
    } 
    catch (Exception $e) {
        header("Location: ../dashboard.php?page=products&error=1");
        exit;
    }
}
?>
