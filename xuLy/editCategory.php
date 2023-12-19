
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../config.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $category_image = ""; 
    $category_category = mysqli_real_escape_string($conn, $_POST['category_category']);
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
    if($category_image == "")  {
        $updateSql = "UPDATE loai SET tenloai = '$category_name'  WHERE maloai = '$category_id'";
    }
    else{
        $updateSql = "UPDATE loai SET tenloai = '$category_name', image='$category_image' WHERE maloai = '$category_id'";
    }
    if ($conn->query($updateSql) === TRUE) {
        header("Location: ../dashboard.php?page=categories");
        exit();
    } else {
        header("Location: ../dashboard.php?page=categories&error=1");
        exit();
    }
}
?>