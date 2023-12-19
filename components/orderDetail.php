<div style="padding:40px;">
    <h3>Bạn đã thanh toán thành công</h3>
    <h2>Chi tiết hóa đơn</h2>
    <div>
        <h4>Mã hóa đơn: <?php echo $order['mahd']; ?></h4>
        <h4>Ngày tạo: <?php echo $order['ngayhd']; ?></h4>
        <h4>Tổng số tiền: <?php echo $sum." $";?></h4>
        <h4>Giao đến: <?php echo $order['diachinguoinhan']; ?></h4>
        <h4>Người nhận: <?php echo $order['tennguoinhan']; ?></h4>
        <h4>Số điện thoại người nhận: <?php echo $order['dienthoainguoinhan']; ?></h4>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <?php
                foreach($products as $item){
                    $sql = "SELECT * FROM sanpham WHERE masp='{$item['masp']}'";
                    $re=$pdo->query($sql);
                    $data=$re->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($data as $key => $value){
                        echo "<tr>";
                        echo "<th><img src='./images/upload/{$value['hinh']}'></th>";
                        echo "<th>{$value['tensp']}</th>";
                        echo "<th>{$value['gia']} $</th>";
                        echo "<th style='with:100px;'>{$item['soluong']}</th>";
                        echo "</tr>";
                    }
                } 
                 ?>
            </table>
        </div>
    </div>
</div>