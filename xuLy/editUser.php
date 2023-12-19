
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../config.php";
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $user_nameUser = mysqli_real_escape_string($conn, $_POST['user_nameUser']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_place = mysqli_real_escape_string($conn, $_POST['user_place']);
        $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
        if($user_password != ""){
            $sql = "UPDATE  user  set matkhau = '$user_password', tenkh='$user_nameUser', email='$user_email', diachi='$user_place', dienthoai='$user_phone' where id = '$user_id'";
        }
        else{
            $sql = "UPDATE  user  set  tenkh='$user_nameUser', email='$user_email', diachi='$user_place', dienthoai='$user_phone' where id = '$user_id'";
        }
        if ($conn->query($sql) === TRUE){
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