<?php
    session_start();
    require_once "../config.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND matkhau=?");
        if ($stmt === false) {
            die("Error in SQL query: " . $conn->error);
        }
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["username"] = $username;
            $_SESSION['count'] = 0;
            $_SESSION['cart'] = array();
            while ($row = $result->fetch_assoc()) {
                if ($row["roleid"] == "admin") {
                    $_SESSION["admin"] = $row['tenkh'];
                    header("Location: .././dashboard.php");
                    exit();
                } else {
                    header("Location: .././index.php");
                    exit();
                }
            }
        } else {
            header("Location: .././login.php?error=1");
            exit();
        }
        $stmt->close();
        $conn->close();
    }
?>