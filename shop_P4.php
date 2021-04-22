<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>台中 環山部落</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/shopbutton.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-info">
        <a class="navbar-brand" href="index.html">環山部落</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="intro.php">牧場介紹</a></li>
                <li><a class="nav-link" href="shop.php">商品</a></li>
                <li><a class="nav-link" href="order.php">我的訂單</a></li>
                <li><a class="nav-link" href="list.php">購物車</a></li>
                <li><a class="nav-link" href="logout.php">登出</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>

    <div class="container">
    <button type="button" class="button button2" value="300"><a href="shop.php">所有商品</a></button>
    <button type="button" class="button button2" value="500"><a href="shop_P1.php">牛奶</a></button>
    <button type="button" class="button button2" value="1000"><a href="shop_P2.php">羊奶</a></button>
    <button type="button" class="button button2" value="1000"><a href="shop_P3.php">羊毛</a></button>
    <button type="button" class="button button2" value="1000"><a href="shop_P4.php">優格</a></button>
      </div>
    <article class="container-fluid " style=" margin-top: 90px; margin-bottom: 150px;">
        <div class="row">
            <div class="col-12 col-xs-6 col-md-6">
                <img class="img-fluid img-thumbnail" src="../img/商店/梨山蜜李.jpg">
                <h4>簡介:</h4>
                <div class="col-12 col-xs-8 col-md-12">生長於高海拔梨山，純淨的山泉水與雲霧裊繞的環境，採用自然農耕孕育出的紅寶石。色澤紅艷、甜中帶酸，果肉細膩、柔嫩多汁。吃起來帶點西瓜口感，因此有「西瓜李」暱稱。</div>
                <br><br>
            </div>
            <div class="col-12 col-xs-6 col-md-6">
                <h2 class="text mt-6 col-md-12">優格</h2>
                <div class="price mt-6 col-md-12"><h4>價格:NT$ 25元/盒</h4></div>
                <br>
                <form action="shop_P4.php" method="post">
                <div class="row">
                    <p class="col-md-3">我要訂購(盒)</p>
                    <p class="col-md-9"><input type="number" name="amount" placeholder="請輸入數量" required></p>
                </div>

                <div class="context" calss="row">
                    <p id="pay">
                    <input type="submit" name="cart" value="加入購物車">
                    <input type="submit" name="now" value="立即購買">
                </div>
              <form>
            </div>

        </div>
        
    </article>
    <button class="bg-info" onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

    <script src="../js/topButton.js"></script>
    <footer class="page-footer bg-info">
        <div class="footer-copyright text-center py-3">2020</div>
    </footer>
</body>

</html>
<?php
$p_id = "P004";

$dbhost = '127.0.0.1';
$dbuser = 'hj';
$dbpass = 'test1234';
$dbname = 'testdb';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
$_SESSION['conn'] = $conn;
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_select_db($conn, $dbname);
//echo $_SESSION[ "password" ];
//$conn = $_SESSION['conn'];
$id = $_SESSION[ "id" ];
//if(isset($_POST["cart"])){
    if(!empty($_POST['amount'])){//如果 重新使用這個頁面(F5) 要先給預設值

        if($_SERVER["REQUEST_METHOD"] == "POST"){ //method = POST 的話
          if(isset($_POST["cart"])){ //檢查是什麼值
                $amount = $_POST[ "amount" ];
                $sum = $amount*25;
                //放入購物車
                //$sql = "UPDATE animal SET A_id='Doe',species='$_GET['newspecies']', newsex='$_GET['newsex']' WHERE id=2";
                $sql = "INSERT INTO shoppingcart(P_id,C_id,buyAmount,sumPrice) VALUES('$p_id','$id',' $amount','$sum')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert('已放入購物車!');</script>";
                }else{
                    echo "<script>alert('新增失敗,請確認是否已經存在');</script>";
                }
          }
          else if(isset($_POST["now"])){
            echo "先不要";
          }
          
        }
        else{
            echo "請輸入數量!!!";
        }
    }
//}
?>