<?php
    $OID = $_REQUEST['OID'];
    $conn = new mysqli("localhost", "root", "", "pos");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }
    if ($OID == 1){
        $sql = "SELECT * FROM `product`;";
    }
    else{
        $sql = "SELECT * FROM `product` where `type` = '$OID';";      
    }
    $product = mysqli_query($conn, $sql);

    mysqli_close($conn);

    echo '<div class="row" style=" padding: 10px;">';
    if (mysqli_num_rows($product) > 0) {
        while ($row = mysqli_fetch_assoc($product)) {
            echo '<div class="col-sm-4 col-6">';
            echo '<div class="dish-card" data-bs-toggle="modal" data-bs-target="#Modal' . $row['ID'] . '">';
            echo '<div class="dish-img-container" style="text-align: center;">';
            echo '<img src="' . $row['IMG'] . '" height="130px"></div>';
            echo '<b style="color: red; font-size:20px;padding-left:10px;">' . $row['ID'] . '.</b><b style="color:#2C3A57;font-size:20px;">'. $row['name'] . '</b>';
            echo '<hr style="margin: 0; width: 100%; color:#2C3A57;">';
            echo '<div style="display: flex;"><div style="width: 80%;">';
            echo '<b style="color: red; font-size:20px;padding-left:10px;">' . $row['price'] . ' đ</b></div>';
            echo '<div style="width: 20%;"><img src="../images/cart1.png" height="25px" style="border-radius: 30%;"></div></div></div></div>';
            echo '<div class="modal fade" id="Modal' . $row['ID'] . '" tabindex="-1" aria-labelledby="ItemModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content">';
            echo '<div class="modal-header" style="background-color: #F0F0F0;">          
            <b style="color:#2C3A57; font-size:22px; padding-left:10px;">Thông tin món ăn</b>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>';
            echo '<div class="modal-body">
            <div class="row">
                <div class="col-md-3" style=" padding-top: 10px;">
                    <div style="border:solid; border-width:3px; height:200px; width:170px;padding:7px;border-color:#F0F0F0;border-radius:10%">';
            echo '<img src="' . $row['IMG'] . '" height="155px">
            </div>
        </div>
        <div class="col-md-9" >
            <div class="row">
                <div style="width:20%;">
                    <b style="color:#2C3A57; font-size:18px; padding-left:10px;">ID</b><br>';
            echo '<b style="color:#2C3A57; font-size:15px; padding-left:10px;">' . $row['ID'] . '</b>
            </div>
            <div style="width:40%;">
                <b style="color:#2C3A57; font-size:18px; padding-left:10px;">Tên món </b><br>';
            echo '<b style="color:#2C3A57; font-size:15px; padding-left:10px;">' . $row['name'] . '</b>
            </div>
            <div style="width:40%; text-align:right;">
                <b style="color:#2C3A57; font-size:18px; padding-left:10px;">Đơn giá </b><br>';
            echo '<b style="color: red; font-size:20px;padding-left:10px;">' . $row['price'] .' đ</b>
            </div>
        </div>
        <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
        <div class="row">
            <div style="width:50%;">
                <b style="color:#2C3A57; font-size:20px; padding-left:10px;">Số lượng </b>
            </div>
            <div style="width:50%; text-align:right;">
                <button onclick="javascript:addOrMinusBtnInModal(\'amount' . $row['ID'] . '\', \'totalprice' . $row['ID'] . '\', ' . $row['price'] . ', 0)" style="width: 30px; height:30px"><b>-</b></button>                               
                <b id="amount' . $row['ID'] . '" style="color:#2C3A57; font-size:18px; padding-left:5px;">
                    1
                </b>
                <button onclick="javascript:addOrMinusBtnInModal(\'amount' . $row['ID'] . '\', \'totalprice' . $row['ID'] . '\', ' . $row['price'] . ', 1)" style="width: 30px; height:30px"><b style="color:red;">+</b></button>
            </div>
        </div>
        <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
        <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Thông tin dinh dưỡng: </b>
        ' . $row['nutrient'] . '</p>
        <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Phụ gia: </b>
        ' .$row['additives'] . '</p>
        <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Trang trí món ăn: </b>
        ' . $row['decoration'] . '</p>
        <div class="row">
            <div class="col-sm-4">
                <b style="color:#2C3A57;font-size:12pt;padding-left:5px;">Yêu cầu đặc biệt: </b>
                <p style="color:#2C3A57;font-size:10pt;padding-left:5px;">(Không bắt buộc)</p>
            </div>
            <div class="col-sm-8">
                <textarea id="note' . $row['ID'] . '" class="form-control" aria-label="With textarea" placeholder="VD: không bỏ hành"></textarea>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal footer -->
<div class="modal-footer" style="text-align: right;">
<button onclick = "javascript:UpdateOrAddFromModal(' . $row['ID'] . ',\'note' . $row['ID'] . '\',\'totalprice' . $row['ID'] . '\',\'amount' . $row['ID'] . '\')" style="width:72%; background-color:red; color:white" type="button"  data-bs-dismiss="modal">
<img src="../images/cart1.png" height="30px">
<b id="totalprice' . $row['ID'] . '">' . $row['price'] . '</b><b> đ</b>
</button>
</div>
</div>
</div>
</div>';
    }
}
    echo '</div>';
?>
