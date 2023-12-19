<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = isset($_POST['username']) ? $_POST['username'] : '';
    $pass_word = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
    $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
    if ($pass_word !== $confirmPassword) {
        $error = "Passwords do not match !";
        header('Location: ../login.php?error=2');
        exit();
    }
    else {
        require_once "../config.php";
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="insert into user(roleid,username,matkhau,email) values('kh','$user_name','$pass_word','$mail')";
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
