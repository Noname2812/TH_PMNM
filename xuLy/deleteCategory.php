<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'])) {
    $id = $_POST['category_id'];
    try {
        require_once "../config.php";
        $uploadImagePath = null;
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT image FROM loai WHERE maloai = :deleteCategoryId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':deleteCategoryId', $id, PDO::PARAM_STR);
        $stmt->execute();
        $uploadImagePath = $stmt->fetchColumn();
        $sql = "DELETE FROM loai WHERE maloai = :deleteCategoryId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':deleteCategoryId', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if (!empty("../images/upload/$uploadImagePath") && file_exists("../images/upload/$uploadImagePath")) {
                unlink("../images/upload/$uploadImagePath");
            }
            header("Location: ../dashboard.php?page=categories");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>