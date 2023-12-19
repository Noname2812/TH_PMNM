<?php 
$user = null;
    if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $categories = array();
    require_once "./config.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "SELECT * FROM user WHERE id = '$userId'";
     $re=$pdo->query($sql);
     $data=$re->fetchAll(PDO::FETCH_ASSOC);
     foreach ($data as $key => $value){
         $user = $value;
     }
 }?>
<div class = 'w-full'>
<form method="post" action="./xuLy/editUser.php" class="w-full flex justify-between" enctype="multipart/form-data">
        <div class="w-1/12 p-2">
            <label for="user_name">User name:</label> <br>
            <p><?php echo $user['username'];?></p>
            <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
        </div>
        <div class="w-1/12 p-2">
            <label for="user_password">Password:</label> <br>
            <input class="w-full" type="password" name="user_password">
        </div>
        <div class="w-1/12 p-2">
            <label for="user_nameUser">Name:</label> <br>
            <input class="w-full" type="text" name="user_nameUser" value="<?php echo $user['tenkh'];?>" required>
        </div>
        <div class="w-2/12 p-2">
            <label for="user_email">Email:</label> <br>
            <input type="text"  class="w-full" name="user_email" value="<?php echo $user['email'];?>" ></input>
        </div>
        <div class='w-2/12 p-2'>
            <label for="user_place">Địa chỉ :</label> <br>
            <input class="w-full" type="text" name="user_place" value="<?php echo $user['diachi'];?>">
        </div>
        <div class="w-2/12 p-2">
            <label for="user_phone">Phone: </label> <br>
            <input class="w-full " type="text" name="user_phone" value="<?php echo $user['dienthoai'];?>">    
        </div>
        <div class="w-3/12 p-2 flex items-center justify-center">
            <button type="submit" class="p-2 bg-green-600 text-white">Update user</button>
        </div> 
</form>
</div>