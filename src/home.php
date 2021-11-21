<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam:wght@100;300&display=swap" rel="stylesheet">
    <link href="../styles/home.css" rel="stylesheet" />
    <title>Home</title>
</head>
<body>
    <div class="nav_bar">
        <div class="homeimg"></div>
        <span class="home">Trang chủ</span>
        <button class="box" style="width: 9vw;left: 22.4vw;" id="abus" onclick="location.href='';return false;"> 
            <span class="nav_bar_text">VỀ NHÀ HÀNG</span>
        </button>
        <button class="box" style="width: 7.3vw;left: 31.875vw;" id="menu" onclick="window.location.href='menu.php';return false;"> 
            <span class="nav_bar_text">THỰC ĐƠN</span>
        </button>
        <button class="box" style="width: 8.75vw;left: 39.9vw;" id="kmai" onclick="location.href='';return false;"> 
            <span class="nav_bar_text">KHUYẾN MÃI</span>
        </button>
        <button class="box" style="width: 6.53vw;left: 49.3vw;" id="datban" onclick="location.href='';return false;"> 
            <span class="nav_bar_text">ĐẶT BÀN</span>
        </button>
        <button class="box" style="width: 6.25vw;left: 56.5vw;" id="lienhe" onclick="location.href='';return false;"> 
            <span class="nav_bar_text">LIÊN HỆ</span>
        </button>
        <a href="" class="user"></a>
        <a href="" class="login">Đăng nhập</a>
    </div>
    <div class="chatbox">
        <div class="send">
            <div class="icon"></div>
            <input type="text" id="message" name="message" placeholder="Nhập tin nhắn tại đây" class="t">
        </div>
        <div class="f10">
        <div class="ava2"></div>
        <div class="bubble1">
            <span class="t1">Xin chào !!!</span>
        </div>
        <div class="bubble2">
            <span class="t1" style="left: 3.92%; right: 3.77%;">Chúng tôi có thể giúp gì cho bạn?</span>
            </div>
        </div>
        <div class="f9">
            <img src="../images/salad.png">
            <span class="gia">Giá chỉ</span>
            <span class="gia2">50.000 đ</span>
            <span class="emphasize">MÓN MỚI CỦA QUÁN</span>
        </div>
        <div class="f8">
            <img src="../images/spaghetti.png">
            <span class="gia">Giá chỉ</span>
            <span class="gia2">50.000 đ</span>
            <span class="emphasize">BESTSELLER !!!</span>
        </div>
        <div class="f7">
            <img src="../images/combo.jpg">
            <span class="gia">Giá chỉ</span>
            <span class="gia2">80.000 đ</span>
            <span class="emphasize">COMBO YÊU THÍCH !!!</span>
        </div>
        <span class="rec">Bạn không biết ăn gì?</span>
        <span class="rec">Đừng lo, vài gợi ý dành cho bạn!</span>
        <div class="top">
            <span class="name">TÊN NHÀ HÀNG</span>
            <div class="call"></div>
            <div class="ava"></div>
            <span class="ll">LIÊN HỆ    1900-XXXX</span>
            <div class="close"></div>
        </div>
    </div>
    <button class="box1" style="top: 10vh" id="abus" onclick="location.href='';return false;"> 
        <span class="nav_bar_text">VỀ NHÀ HÀNG</span>
    </button>
    <button class="box1" style="top: 11vh" id="menu" onclick="location.href='menu.php';return false;"> 
        <span class="nav_bar_text">THỰC ĐƠN</span>
    </button>
    <button class="box1" style="top: 12vh" id="kmai" onclick="location.href='';return false;"> 
        <span class="nav_bar_text">KHUYẾN MÃI</span>
    </button>
    <button class="box1" style="top: 13vh" id="datban" onclick="location.href='';return false;"> 
        <span class="nav_bar_text">ĐẶT BÀN</span>
    </button>
    <button class="box1" style="top: 14vh" id="lienhe" onclick="location.href='';return false;"> 
        <span class="nav_bar_text">LIÊN HỆ</span>
    </button>
    <div class="bubble"></div>

    <script>
        var modal = document.getElementsByClassName("chatbox")[0];
        var btn = document.getElementsByClassName("bubble")[0];
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
          modal.style.display = "block";
          span.style.display = "block";
        }
        span.onclick = function() {
          modal.style.display = "none";
          span.style.display = "none";
        }
        </script>
<?php echo "    <div class=\"bg\"></div>
</body>
</html>";

