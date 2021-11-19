<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "pos";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($conn->connect_error){
	die("Connection Failed!".$conn->connect_error);
}

$sql = "SELECT * FROM `order` ORDER BY `ID` DESC LIMIT 1;";
$order = mysqli_query($conn, $sql);

if (mysqli_num_rows($order) == 0) {
    $sql = "INSERT INTO `order`(`status`) VALUES(0);";
    $order = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM `order` ORDER BY `ID` DESC LIMIT 1;";
    $order = mysqli_query($conn, $sql);
    $order = mysqli_fetch_assoc($order);
}
else{
    $order = mysqli_fetch_assoc($order);
    if($order["status"] == 1){
        $sql = "INSERT INTO `order`(`status`) VALUES(0);";
        $order = mysqli_query($conn, $sql);
        $order = mysqli_fetch_assoc($order);
    }
}




$orderID=$order['ID'];

$sql = "SELECT * FROM `category`;";
$category = mysqli_query($conn, $sql);

$sql = "SELECT * FROM `product`;";
$product = mysqli_query($conn, $sql);
$modal = mysqli_query($conn, $sql);

$sql = "SELECT * FROM `table`;";
$table = mysqli_query($conn, $sql);

$sql = "SELECT A.ID AS ID, A.name AS name, A.nutrient as nutrient, A.additives as additives, A.decoration as decoration, A.IMG AS IMG, B.quantity AS qty, B.note as note, B.total_price as tprice, A.price as price FROM `product` AS A,`cart` AS B WHERE B.orderID = '$orderID' AND A.ID = B.productID;";
$cart = mysqli_query($conn, $sql); 

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../styles/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // delete product in cart
        function delProInCart(ID){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "delProInCart.php?ProIDToDel=" + ID, true);
            xmlhttp.send();
            location.reload();
        }
        // mode = 0 is decreasing; mode = 1 is increasing
        function inOrDecreaseQty(PID,curQty, mode){
            var newQty = (mode == 0)? curQty - 1 : curQty + 1;
            var xmlhttp = new XMLHttpRequest();
            if(newQty == 0) delProInCart(PID);
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "inOrDecreaseQty.php?newQty=" + newQty + "&PIDToChange=" + PID, true);
            xmlhttp.send();
            location.reload();
        }
        function updateTableOfOrder(table){

        }
        

    </script>

    <title>menu</title>
</head>
<body>

    <div class="container-fluid" >
        <div class="row">

            <div class="col-sm-8" style="background-color:#F8F8F8; padding:0;">

                <div class="container-fluid" id="menu-header" style="padding:0;">

                    <div class="row">
                        <div class="col-sm-6" style="align-items:center; background-color:#fff; padding: 10px;">
                            <img src="../images/home.png" height="50px" style="margin-left: 10px;">
                            <b style="color:#2C3A57; font-size:20px;">Về trang chủ</b>
                        </div>
    
                        <div class="col-sm-6" id="search-container" style="background-color:#fff;">
                            <input style="margin-top: 15px; margin-bottom:10px; margin-left:15%;" type="search" name="search-box" id="search-box">
                            <button ><img src="../images/search.png" height="17px"></button>
                        </div>
                    </div>

                </div>

                <main id="category-container" style="padding: 10px;">
                    <section id="category">
                    <?php while ($row = mysqli_fetch_assoc($category)) { ?>
                        <div class="type-item shadow">
                            <img src="<?php echo $row['IMG'];?>" height="100px">  
                            <br><b style="color:#2C3A57;"><?php echo $row['name'];?></b>
                        </div>
                    <?php } ?>
                    </section>
                </main>

                <div class="container-fluid" id="menu-break" style="padding:0;">

                    <div class="row">
                        <div class="col-sm-2" style=" padding: 10px;">
                            <b style="color:#2C3A57; font-size:19px; padding-left:10px;">Tất cả</b>
                        </div>
                        <div class="col-sm-10" >
                            <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
                        </div>
                    </div>

                </div>
                <!-- main menu -->
                <div class="row" style=" padding: 10px;">
                <?php if (mysqli_num_rows($product) > 0) {while ($row = mysqli_fetch_assoc($product)) { ?>
                    <div class="col-sm-4 col-6">
                        <div class="dish-card" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $row['ID']; ?>">
                            <div class="dish-img-container" style="text-align: center;">
                                <img src="<?php echo $row['IMG']; ?>" height="130px">
                            </div>
                            <b style="color: red; font-size:20px;padding-left:10px;"><?php echo $row['ID']; ?>.</b><b style="color:#2C3A57;font-size:20px;"> <?php echo $row['name']; ?> </b>
                            <hr style="margin: 0; width: 100%; color:#2C3A57;">
                            <div style="display: flex;">
                                <div style="width: 80%;">
                                    <b style="color: red; font-size:20px;padding-left:10px;"><?php echo $row['price']; ?> đ</b>
                                </div>
                                <div style="width: 20%;">
                                    <img src="../images/cart1.png" height="25px" style="border-radius: 30%;">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
                </div>
            </div>
            
            
            <div class="col-sm-4 shadow" id="cart" style=" padding:0;">
                <div id="cart-container">
                    <!--Header of cart-->
                    <div class="head" style="display:flex;">
                        <div style="display:flex; padding-top:10px; padding-left:10px; padding-bottom:10px;">
                            <img class="cart-side-icon" src="../images/cart.png" height="25px">
                            <b style="color: red; font-size:20px;padding-left:10px;">Món đã đặt</b>
                        </div>
                        
                        <div style="padding-top:10px; margin-left:90px;">
                            <form method="POST">
                            <select id="tableNum" name="table-Number">
                                <?php while ($row = mysqli_fetch_assoc($table)) { ?>
                                <option value="<?php echo $row['ID']; ?>" <?php if($row['ID']==$order['table']) echo 'selected';?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                            <input type = "submit" name="changetable" value="Chọn"/>
                            </form>
                            <?php
                                if(isset($_POST['changetable'])){
                                    $gettable=$_POST["table-Number"];
                                    $conn = new mysqli("localhost", "root", "", "pos");
                                    if($conn->connect_error){
	                                    die("Connection Failed!".$conn->connect_error);
                                    }
                                    $sql = "UPDATE `order` SET `table`= '$gettable' WHERE ID = '$orderID';";
                                    $order = mysqli_query($conn, $sql);                           
                                }
                            ?>
                        </div>                
                    </div>

                    <!--body of cart-->
                    <div class="bill-container">

                    <?php if (mysqli_num_rows($cart) > 0) { while ($row = mysqli_fetch_assoc($cart)) { ?>
                        <div class="product-in-cart" style="margin-bottom:10px;">
                            <div class="product-img">
                                <img src="<?php echo $row['IMG'];?>" height="70px" style="margin-top:2px;">
                            </div>
                            <div style="width: 40%;padding-top:10px;padding-left:10px; margin-left:10px;">
                                <b style="color:#2C3A57; font-size:15px;">
                                    <?php echo $row['name'];?>
                                </b><br>
                                <button onclick = "inOrDecreaseQty(<?php echo $row['ID'].','. $row['qty'];?>,0)" style="width: 30px; height:30px"><b>-</b></button>                               
                                <b style="color:#2C3A57; font-size:15px; padding-left:5px;">
                                <?php echo $row['qty'];?>
                                </b>
                                <button onclick = "inOrDecreaseQty(<?php echo $row['ID'].','. $row['qty'];?>,1)" style="width: 30px; height:30px"><b style="color:red;">+</b></button>
                            </div>
                            <div style="width: 40%; text-align:right;">
                                <button onclick="delProInCart(<?php echo $row['ID'];?>)" style="margin-right:5px;border-color:white;background-color:white"><img src="../images/close.png" height="11px"></button>
                                <br><b style="color: red; font-size:18px;padding-right:10px;"><?php echo $row['tprice'];?> đ</b>
                            </div>
                        </div>

                    <?php }} ?>
                    </div>
                    <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
                    <!--cart footer-->
                    <div class="cart-footer">
                        <div style="text-align: left; width:50%;">
                            <b style="color:#2C3A57; font-size:19px; padding-left:10px;">Tổng cộng:</b>
                        </div>
                        <div style="text-align: right; width:50%;">
                            <b style="color: red; font-size:20px;padding-right:10px;"><?php echo $order['total_price'];?> đ</b><br>
                            <b style="color:#2C3A57; font-size:12px; padding-right:10px;">Đã bao gồm 10% VAT</b>
                        </div>
                    </div>
                    <button style="color: white; background-color:red; font-weight:bold; width:90%;margin-left:5%; margin-top:10px;margin-bottom:10px;">
                        Thanh toán
                    </button>
                </div>
            </div>
        </div>
    </div>


    <?php if (mysqli_num_rows($modal) > 0) {while ($row = mysqli_fetch_assoc($modal)) { ?>
    <div class="modal fade" id="Modal<?php echo $row['ID']; ?>" tabindex="-1" aria-labelledby="ItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
      
            <!-- Modal Header -->
                <div class="modal-header" style="background-color: #F0F0F0;">          
                    <b style="color:#2C3A57; font-size:22px; padding-left:10px;">Thông tin món ăn</b>
                    <button onclick = "location.reload()" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
      
            <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3" style=" padding-top: 10px;">
                            <div style="border:solid; border-width:3px; height:200px; width:170px;padding:7px;border-color:#F0F0F0;border-radius:10%">
                                <img src="<?php echo $row['IMG']; ?>" height="155px">
                            </div>
                        </div>
                        <div class="col-md-9" >
                            <div class="row">
                                <div style="width:20%;">
                                    <b style="color:#2C3A57; font-size:18px; padding-left:10px;">ID</b><br>
                                    <b style="color:#2C3A57; font-size:15px; padding-left:10px;"><?php echo $row['ID']; ?></b>
                                </div>
                                <div style="width:40%;">
                                    <b style="color:#2C3A57; font-size:18px; padding-left:10px;">Tên món </b><br>
                                    <b style="color:#2C3A57; font-size:15px; padding-left:10px;"><?php echo $row['name']; ?></b>
                                </div>
                                <div style="width:40%; text-align:right;">
                                    <b style="color:#2C3A57; font-size:18px; padding-left:10px;">Đơn giá </b><br>
                                    <b style="color: red; font-size:20px;padding-left:10px;"><?php echo $row['price']; ?> đ</b>
                                </div>
                            </div>
                            <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
                            <div class="row">
                                <div style="width:50%;">
                                    <b style="color:#2C3A57; font-size:20px; padding-left:10px;">Số lượng </b>
                                </div>
                                <div style="width:50%; text-align:right;">
                                    <button onclick="javascript:addOrMinusBtnInModal('amount<?php echo $row['ID']; ?>', 'totalprice<?php echo $row['ID']; ?>', <?php echo $row['price']; ?>, 0)" style="width: 30px; height:30px"><b>-</b></button>                               
                                    <b id="amount<?php echo $row['ID']; ?>" style="color:#2C3A57; font-size:18px; padding-left:5px;">
                                        1
                                    </b>
                                    <button onclick="javascript:addOrMinusBtnInModal('amount<?php echo $row['ID']; ?>', 'totalprice<?php echo $row['ID']; ?>', <?php echo $row['price']; ?>, 1)" style="width: 30px; height:30px"><b style="color:red;">+</b></button>
                                </div>
                            </div>
                            <hr style="margin-top: 20px; width: 99%; color:#C4C4C4;">
                            <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Thông tin dinh dưỡng: </b>
                            <?php echo $row['nutrient']; ?></p>
                            <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Phụ gia: </b>
                            <?php echo $row['additives']; ?></p>
                            <p style="color:#2C3A57; font-size:16px; padding-left:5px;"><b>Trang trí món ăn: </b>
                            <?php echo $row['decoration']; ?></p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <b style="color:#2C3A57;font-size:12pt;padding-left:5px;">Yêu cầu đặc biệt: </b>
                                    <p style="color:#2C3A57;font-size:10pt;padding-left:5px;">(Không bắt buộc)</p>
                                </div>
                                <div class="col-sm-8">
                                    <textarea id="note<?php echo $row['ID']; ?>" class="form-control" aria-label="With textarea" placeholder="VD: không bỏ hành"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      
            <!-- Modal footer -->
            <div class="modal-footer" style="text-align: right;">
              <button onclick = "javascript:UpdateOrAddFromModal(<?php echo $row['ID']?>,'note<?php echo $row['ID']; ?>','totalprice<?php echo $row['ID']; ?>','amount<?php echo $row['ID']; ?>')" style="width:72%; background-color:red; color:white" type="button"  data-bs-dismiss="modal">
                  <img src="../images/cart1.png" height="30px">
                  <b id="totalprice<?php echo $row['ID']; ?>"><?php echo $row['price']; ?></b><b> đ</b>
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php }} ?>

    <script type="text/javascript">
        // add: mode = 1; minus: mode = 0
        function addOrMinusBtnInModal(amountID, totalpriceID, price, mode){
            var amount = parseInt(document.getElementById(amountID).innerHTML.trim());
            amount = (mode == 1)? amount + 1: amount - 1;
            if(amount == 0) return;
            var total = amount * price;
            document.getElementById(amountID).innerHTML = amount.toString();
            document.getElementById(totalpriceID).innerHTML = total.toString();
        }

        function UpdateOrAddFromModal(PID, note, total_price, quantity){
            var qty = parseInt(document.getElementById(quantity).innerHTML.trim());
            var total = parseInt(document.getElementById(total_price).innerHTML.trim());
            var notetext = document.getElementById(note).value.toString();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "UpdateOrAddFromModal.php?ProID=" + PID + "&note=" + notetext + "&total=" + total + "&qty="+ qty, true);
            xmlhttp.send();
            location.reload();
        }
    </script>

</body>
</html>

