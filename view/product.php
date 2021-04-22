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
        <a class="navbar-brand" href="index.html">觀光牧場</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link" href="worker.php">原料資訊</a></li>
                <li><a class="nav-link" href="product.php">生產資訊</a></li>
                <li><a class="nav-link" href="order.php">通知</a></li>
                <li><a class="nav-link" href="logout.php">登出</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>
</body>
<?php session_start(); 
    if($_SESSION['username'] == null){ 
      //header("Location: xxxx.com");
      echo '<meta http-equiv=REFRESH CONTENT=2;url=http://localhost/php_example/main.php>';  
      echo "<script>history.forward()</script>";
      exit(); 
    }
?>
      <label>選擇索引條件：</label>
      <select id="select" name="select" onchange="change(value)">
        <option  value="select-t">---</option>
        <option  value="select-a">全部</option>
　      <option  value="select-b">牛製品</option>
　      <option  value="select-c">羊製品</option>
      </select>
      <script>
        function change(value){
            //document.getElementById("select").innerHTML=value;
            location.href="Product.php?value=" +value;
        }
      </script>
<?php
    if(!empty($_GET['new'])){//如果 重新使用這個頁面(F5) 要先給預設值
      if($_SERVER["REQUEST_METHOD"] == "GET"){ //method = GET 的話
        if($_GET['select'] == "select-a"){ //檢查是什麼值
          echo $_GET['select'];
        }
        else if($_GET['select'] == "select-b"){
          echo $_GET['select'];
        }
        else if($_GET['select'] == "select-c"){
          echo $_GET['select'];
        }
        else if($_GET['select'] == "select-d"){
          echo $_GET['select'];
        }
      }
    }
    ?>

    <form action="product.php" method="post">
    <p>新增產品資訊</p>
    <label>編號：</label><input type="text" name="newid" >
    <label>品名：</label><input type="text" name="newname" >
    <label>價格：</label><input type="text" name="newprice" >
    <input type="submit" name="new" value="新增">
    <br>
    </form>
    <p>更新產品資訊</p>
    <form action="product.php" method="get">
    <label>編號：</label><input type="text" name="update-id" >
    <label>價格：</label><input type="text" name="update-price" >
    <label>數量：</label><input type="text" name="update-amount" >
    <input type="submit" name="update" value="更新">

    </form>

    
<?php
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



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(!empty($_GET["update"])){
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $upId = test_input($_GET["update-id"]);
    $upPrice = test_input($_GET["update-price"]);
    $upAmount = test_input($_GET["update-amount"]);
  }
}
if(!empty($_GET["update"])){
      if(empty($upId)){
        echo "<br>請輸入欲修改產品編號";
      }else{
          if($_SERVER["REQUEST_METHOD"] == "GET"){
            if($upPrice != ""){
              $sql = "UPDATE product SET price='$upPrice' where P_id='$upId' ";
              $result = mysqli_query($conn, $sql) or die('MySQL query error');
            }
            if($upAmount != ""){
              $sql = "UPDATE product SET amount='$upAmount' where P_id='$upId'";
              $result = mysqli_query($conn, $sql) or die('query error');
            }
          echo "更新成功<br>";
        }
      }
}



  if(!empty($_POST["new"])){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          if (empty($_POST["newid"])) {
            echo "。請輸入編號", "<br>";
          } else {
            $newid = test_input($_POST["newid"]);
          }
          if (empty($_POST["newname"])) {
            echo '。請輸入品名', "<br>";
          } else {
            $newname = test_input($_POST["newname"]);
          }
        
          if (empty($_POST["newprice"])) {
            echo "。請輸入價格", "<br>";
          } else {
            $newprice = test_input($_POST["newprice"]);
          }
      }
   }

      if(isset($newname) AND isset($newprice) AND isset($newid)){

        //$sql = "UPDATE animal SET A_id='Doe',species='$_GET['newspecies']', newsex='$_GET['newsex']' WHERE id=2";
        $sql = "INSERT INTO product(P_id,P_name,price) VALUES('$newid','$newname','$newprice')";
        $result = mysqli_query($conn, $sql);
        if($result){
          echo "新增成功!<br>";
        }else{
          echo'新增失敗,請確認產品是否已經存在<br>';
        }
        
      } 
      else {
          if(!empty($_POST["new"])){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
              echo "error<br>";
            }
        }
      }

      echo $_SESSION[ "id" ];
      echo "<br>使用者 : ";
      echo $_SESSION["Name"],"<br><br>";

    if(isset($_GET['value'])){
        if($_GET['value'] == "select-a"){
            $sql = "SELECT * FROM product ;";
            echo "編號 名稱 單價 數量<br><br>";
            $result = mysqli_query($conn, $sql) or die('MySQL query error');
            while($row = mysqli_fetch_array($result)){
                $tmp = $row['P_id'];
                echo "<a href=Adetail.php?A_id=$tmp>".$row['P_id']."</a>";
                echo  "\t";
                echo  $row['P_name'],"     ", $row['price'], "        " , $row['amount'], "\t", "<p>";
                echo "<br>";
            }
        }
        else if($_GET['value'] == "select-b"){
           $sql = "SELECT * FROM product where P_name like '%牛%';";
           $result = mysqli_query($conn, $sql) or die('MySQL query error');
           echo "編號 名稱 單價 數量<br><br>";
           while($row = mysqli_fetch_array($result)){
           //echo $row['A_id'], $row['E_id'],"<p>";
           $tmp = $row['P_id'];
           //$_SESSION["Aid"] = $tmp;//有問題 會給迴圈最後一次的值
           echo "<a href=Adetail.php?A_id=$tmp>".$row['P_id']."</a>";
           echo  "\t";
           echo  $row['P_name'],"     ", $row['price'], "        " , $row['amount'], "\t", "<p>";
           echo "<br>";  
           }
        }
        else if($_GET['value'] == "select-c"){
           $sql = "SELECT * FROM product where P_name like '%羊%';";
           $result = mysqli_query($conn, $sql) or die('MySQL query error');
           echo "編號 名稱 單價 數量<br><br>";
           while($row = mysqli_fetch_array($result)){
           //echo $row['A_id'], $row['E_id'],"<p>";
           $tmp = $row['P_id'];
           //$_SESSION["Aid"] = $tmp;//有問題 會給迴圈最後一次的值
           echo "<a href=Adetail.php?A_id=$tmp>".$row['P_id']."</a>";
           echo  "\t";
           echo  $row['P_name'],"     ", $row['price'], "        " , $row['amount'], "\t", "<p>";
           echo "<br>";
           }
        }
        
     }
      
    ?>