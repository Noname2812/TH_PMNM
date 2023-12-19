<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../config.php";
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $user_nameUser = mysqli_real_escape_string($conn, $_POST['user_nameUser']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_place = mysqli_real_escape_string($conn, $_POST['user_place']);
        $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
        $sql = "INSERT INTO user (roleid, username,matkhau,tenkh,email,diachi,dienthoai)
                VALUES ('kh', '$user_name','$user_password','$user_nameUser','$user_email','$user_place','$user_phone')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../dashboard.php?page=users");
            exit;
        }
        else{
            header("Location: ../dashboard.php?page=users&error=1");
            exit;
        }
        $conn->close();
    }
    catch (PDOException $e){
        header("Location: ../dashboard.php?page=users&error=1");
        exit;
    }
}
?>
