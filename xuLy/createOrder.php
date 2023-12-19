<?php 
 session_start();
 include_once "../utils.php";
$sum =subtotalCart();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../config.php";
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $customer_name = mysqli_real_escape_string($conn, $_POST['name']);
        $customer_place = mysqli_real_escape_string($conn, $_POST['address']);
        $customer_phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $currentDateTime = date("d/m/y");
        $mahd = md5($user_name."".bin2hex(random_bytes(10)));
        $id="";
        $sql = "SELECT id FROM user WHERE username = '$user_name'";
        $result = $conn->query($sql);
        if ($result === FALSE) {
            die("Error executing the query: " . $conn->error);
        }
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row['id'];
            }

        $sql = "INSERT INTO hoadon (mahd, id,ngayhd,tennguoinhan,diachinguoinhan,dienthoainguoinhan)
                VALUES ('$mahd', '$id','$currentDateTime','$customer_name','$customer_place','$customer_phone')";
        if ($conn->query($sql) === TRUE) {
            if(isset($_SESSION['cart'])){
                $temp = $_SESSION['cart'];
                foreach($temp as $key => $val){
                    $sql = "INSERT INTO chitiethd VALUES ('$mahd','{$val['id']}','{$val['quantity']}','{$val['price']}')";
                    $result = $conn->query($sql);
                    if ($result === FALSE) {
                        die("Error executing the query: " . $conn->error);
                    }
                }

            }
            $_SESSION['cart'] = array();
            $_SESSION['count'] = 0;
            header("Location: ../cart.php?checkout=2&id=$mahd&sum=$sum");
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