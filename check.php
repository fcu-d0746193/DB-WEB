<?php session_start();
//require  'session.php';
//Get values passe from form in login.php file
$dbhost = '127.0.0.1';
$dbuser = 'hj';
$dbpass = 'test1234';
$dbname = 'testdb';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
$_SESSION['conn'] = $conn;
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_select_db($conn, $dbname);
$id = $_SESSION[ "id" ];
if(isset($_GET['sum'])){
  $_SESSION['sum'] = $_GET['sum'];
}

  if(isset($_POST['create']) ){//按下建立後
    $sql = "INSERT INTO orders(C_id,sum)values ('$id','{$_SESSION['sum']}');";//新增訂單
    $result = mysqli_query($conn, $sql) or die('1');

    $sql = "SELECT O_id FROM orders WHERE C_id = '$id' AND sum ='{$_SESSION['sum']}';";//取出訂單編號
    $result = mysqli_query($conn, $sql) or die('2');


    while($row = mysqli_fetch_array($result)){
       $O_id = $row['O_id'];
    }

    $sql = "SELECT * FROM shoppingcart WHERE C_id = '$id';";
    $result = mysqli_query($conn, $sql) or die('3');


    while($row = mysqli_fetch_array($result)){
      $P = $row['P_id'];
      $sqlc = "INSERT INTO have(O_id,P_id,C_id,buyAmount,sumPrice)values('$O_id','$P','$id','{$row['buyAmount']}','{$row['sumPrice']}');";//建立訂單
      $resultc = mysqli_query($conn, $sqlc) or die('MySQL query error');
      //echo "<script>alert('訂單建立成功')</script>";
    }

    $sql = "DELETE FROM shoppingcart WHERE C_id = '$id';";//清除購物車
    $result = mysqli_query($conn, $sql) or die('失敗');
      //echo "<script>alert('訂單建立成功')</script>";

    
    echo "<script>alert('訂單建立成功');location.href='http://localhost/php_example/shop.php';</script>";
  }

//
  $sql = "SELECT * FROM customer WHERE C_id = '$id';";
  $result = mysqli_query($conn, $sql) or die('MySQL query error');

  echo "訂單資料確認 :<br><br>";
  while($row = mysqli_fetch_array($result)){
    echo "姓名:  ",$row['C_name'], "<br>   ";
    echo "聯絡電話:  ",$row['phoneNumber'],"<br>";
    echo "送貨地址:  ", $row['address'], "<br>   ";

    if($row['pay_type'] == NULL && empty($_POST['num'])){
      echo "<br>尚未選擇付款方式";
      echo "<br>請選擇付款方式";
?>
     <form action = check.php method="post">
     <label><input type="radio" name="way" value="A" checked>銀行帳戶匯款</label>
     <label><input type="radio" name="way" value="B">信用卡付費</label>
     <br>
     <label>輸入號碼<input type="text" name="num" require></label>
     <label><input type="submit" name="submit" value="提交"></label>
    </form>
<?php
     }
    if(isset($_POST['submit'])){
     //if($row['pay_type']=NULL){
      if($_POST['way'] == "A"){
        $way = $_POST['way'];
        $num = $_POST['num'] ;

        $sql1 = "UPDATE customer SET bank_num= '$num' WHERE C_id = '$id';";
        $result1 = mysqli_query($conn, $sql1) or die('MySQL query error');
        $sql1 = "UPDATE customer SET pay_type= '$way' WHERE C_id = '$id';";
        $result1 = mysqli_query($conn, $sql1) or die('MySQL query error');


        $sql = "SELECT * FROM customer WHERE C_id = '$id';";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);


      }
      else if($_POST['way'] == "B"){
        $way = $_POST['way'];
        $num = $_POST['num'] ;
        $sql2 = "UPDATE customer SET card_num='{$_POST['num']}' ,pay_type= '{$_POST['way']}' WHERE C_id = '$id';";
        $result2 = mysqli_query($conn, $sql2) or die('MySQL query error');

        $sql = "SELECT * FROM customer WHERE C_id = '$id';";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
      }
  }
  if($row['pay_type'] == "A"){

    echo "您選擇銀行匯款方式<br>";
    echo "銀行帳號:",$row['bank_num'],"<br><br>";
?>
  
<?php
  }
  if($row['pay_type'] == "B"){
    echo "您選擇信用卡付款方式<br>";
    echo "信用卡帳號:",$row['card_num'],"<br><br>";
  }
  echo "<br>本次下訂金額 : ",$_SESSION['sum'],"<br>";
?>
<?php
}
?>
 <form action="check.php" method="post">
 <label><input type="submit" name="create" value="建立訂單"></label>
 </form>
<?php
//  "SELECT address,bank_num,card_num FROM customer as c,shoppingcart as s  WHERE c.C_id = '$id' AND s.C_id = '$id' AND s.C_id = c.C_id;";
//onclick="chose('<?php echo $_POST['person'];



?>