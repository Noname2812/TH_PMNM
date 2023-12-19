<div class="w-full">
<h1 class='text-center text-2xl text-blue-600 pb-8'>List user</h1>
<div class="w-full">
<form method="post" action="./xuLy/addUser.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="user_name">User name:</label> <br>
            <input class="w-full" type="text" name="user_name" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="user_password">Password:</label> <br>
            <input class="w-full" type="password" name="user_password" required>
        </div>
        <div class="w-1/12 p-2">
            <label for="user_nameUser">Name:</label> <br>
            <input class="w-full" type="text" name="user_nameUser" required>
        </div>
        <div class="w-2/12 p-2">
            <label for="user_email">Email:</label> <br>
            <input type="text"  class="w-full" name="user_email" ></input>
        </div>
        <div class='w-2/12 p-2'>
            <label for="user_place">Địa chỉ :</label> <br>
            <input class="w-full" type="text" name="user_place">
        </div>
        <div class="w-2/12 p-2">
            <label for="user_phone">Phone: </label> <br>
            <input class="w-full " type="text" name="user_phone">    
        </div>
        <div class="w-3/12 p-2 flex items-center justify-center">
            <button type="submit" class="p-2 bg-green-600 text-white">Add Product</button>
        </div> 
</form>
<?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;">Add fail !</p>';
    }
 ?>
</div>
<table class='min-w-full bg-white border border-gray-300'>
<thead>
     <tr>
            <th class='py-2 px-2 border-r border-b w-1/12'>ID</th>
            <th class='py-2 px-2 border-r border-b w-1/12'>Username</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Name</th>
           <th class='py-2 px-2 border-r border-b w-1/12'>Email</th>
           <th class='py-2 px-2 border-r border-b w-3/12'>Địa chỉ</th>
           <th class='py-2 px-2 border-r border-b w-2/12'>Số điện thoại</th>
            <th class='py-2 px-2 border-b w-3/12'></th>
    </tr>
</thead>
<tbody>
<?php
try {
    require_once "./config.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="select * from user where roleid='kh'";
    $re=$pdo->query($sql);
    $data=$re->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $key => $value) {
        echo "<tr class='border-b'>";
        echo "<td class='py-2 px-2 border-r text-center'>#{$value['id']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['username']}</td>";
        echo "<td class='py-2 px-2 border-r'>{$value['tenkh']} đ</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['email']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['diachi']}</td>";
        echo "<td class='py-2 px-2 border-r text-center'>{$value['dienthoai']}</td>";
        echo "<td class='py-2 px-2 border-b text-center flex gap-8 justify-center'>";
        echo "<form action='./xuLy/deleteUser.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-red-600 rounded text-white' name='delete_user'>";
        echo "Delete";
        echo "</button>";
        echo "<input type='hidden' name='user_id' value='{$value['id']}'/>";
        echo "</form>";  
        echo "<form action='dashboard.php' method='post'>";
        echo "<button type='submit' class='p-2 bg-blue-600 rounded text-white'>Update</button>";
        echo "<input type='hidden' name='update_user_id' value='{$value['id']}'/>";
        echo "</form>"; 
        echo "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
}
?>
</tbody>
</table>
</div>