<head>
    <title>觀光牧場</title>
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
        <a class="navbar-brand" href="index.html">觀光牧場</a>
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
        </div>
    </nav>
    <br><br><br>
<?php session_start(); 
    if($_SESSION['username'] == null){ 
      //header("Location: xxxx.com");
      echo '<meta http-equiv=REFRESH CONTENT=2;url=http://localhost/php_example/main.php>';  
      echo "<script>history.forward()</script>";
      exit(); 
    }
?>
<?php     
    $dbhost = '127.0.0.1';
    $dbuser = 'hj';
    $dbpass = 'test1234';
    $dbname = 'testdb';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    $_SESSION['conn'] = $conn;
    mysqli_query($conn, "SET NAMES 'utf8'");
    mysqli_select_db($conn, $dbname);

    if(isset($_GET['value'])){
        $Ssql = "DELETE FROM shoppingcart WHERE P_id = '{$_GET['value']}';";
        mysqli_query($conn, $Ssql) or die('MySQL query error');
        $_GET['value']=NULL;
    }
    
    $id = $_SESSION[ "id" ];
    $sql = "SELECT * FROM shoppingcart WHERE C_id = '$id';";
    $result = mysqli_query($conn, $sql) or die('MySQL query error');

    echo "<br>使用者 : ";
    echo $_SESSION["Name"],"<br><br>";

    $sum=0;
    while($row = mysqli_fetch_array($result)){
       $sum += $row['sumPrice'];
       if( $sum != 0){
        echo "<br>商品  數量  價格<br>";
       }
       //echo $row['A_id'], $row['E_id'],"<p>";
       $tmp = $row['P_id'];
       $Psql = "SELECT P_name FROM product WHERE P_id = '$tmp';";
       $Presult = mysqli_query($conn, $Psql) or die('MySQL query error');
       //if($row['P_id'] == )
       //$_SESSION["Aid"] = $tmp;//有問題 會給迴圈最後一次的值
       if($Prow = mysqli_fetch_array($Presult)){//印出產品名稱
         echo $Prow['P_name'];
         echo  "\t";
       }

       echo  $row['buyAmount']," 個 ", $row['sumPrice']," 元 ", "\t\t";
       //echo "取消", "<br>";
?><?php
?>
       <input type="button"  class="button button2" value="取消" onclick="delet('<?php echo $tmp;?>')">
       <script>

        function delet(string){
            location.href="list.php?value=" +string;
            alert("確認刪除");
               //$Ssql = "DELETE FROM shoppingcart WHERE P_id = '$value';";
               //mysqli_query($conn, $Ssql) or die('MySQL query error');
        }
       </script>
       <p id="delete"></P>

<?php 
        echo "<br>"; 
     }

     if(isset($_POST['send']) && $sum != 0){
        echo "<script>location.href='http://localhost/php_example/check.php?sum=$sum';</script>";
      }
   
     
     /*var tmp=<?php echo $tmp; ?>;
     document.write(tmp);
     document.getElementById("delete").innerHTML=tmp;
     */
    /*$sql = "SELECT address, bank_num, card_nun FROM customer where C_id =  '{$_SESSION[ id" ]}';";
    $result = mysqli_query($conn, $sql) or die('MySQL query error');
    while($row = mysqli_fetch_array($result)){
        <form action="Adetail.php" method="post">
        <label>地址：</label><input type="text" name="update-cost" ><br>
        <label>狀況：</label><input type="text" name="update-health" ><br>
        <label>產量：</label><input type="text" name="update-yield" ><br>
        <input type="submit" name="update" value="更新">
    </form>*/
    if($sum != 0)
    {
        echo "總計 : ",$sum," 元";
?>
    <form action="list.php" method="post">
       <input type="submit"  class="button button2" name="send" value="結帳" >
    </form>
<?php
    }
    else{
        echo "您的購物車是空的";
    }
?>