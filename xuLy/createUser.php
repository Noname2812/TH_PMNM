<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match !";
        header('Location: ../login.php?error=2');
        exit();
    }
    else {
        require_once "../config.php";
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="insert into user(roleid,username,matkhau,email) values('kh','$username','$password','$mail')";
        try{
            $pdo->query($sql);
            header("Location: ../login.php?error=3");
            exit;
        }
        catch(PDOException $e)
        {
            header("Location: ../login.php?error=4");
            exit;
        }
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
