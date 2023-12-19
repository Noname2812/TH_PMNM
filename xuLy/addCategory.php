<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../config.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_image = ""; 
    if (isset($_FILES["category_image"])) {
        $image = $_FILES["category_image"];
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
            $category_image = $newImageName;
        }
    }
    $sql = "INSERT INTO loai (maloai, tenloai,image)
            VALUES ('$category_id', '$category_name','$category_image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../dashboard.php?page=categories");
        exit;
    } else {
        unlink($uploadImagePath);
        header("Location: ../dashboard.php?page=categories&error=1");
        exit;
    }
    $conn->close();
}
?>
