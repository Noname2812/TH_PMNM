<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    try {
        require_once "../config.php";
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM user WHERE id = :deleteUser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':deleteUser', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            header("Location: ../dashboard.php?page=users");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>