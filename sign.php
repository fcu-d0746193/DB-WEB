<div class="container">
        <form action="sign.php" method="post">
            <label for="name">您的姓名:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="phone">電話號碼:</label>
            <input type="tel" id="phone" name="phone" placeholder="0912345678" pattern="[0-9]{10}"
                required><br>
            <small>Format: 0912345678</small><br><br>
            <!--<label for="adrs">您的地址:</label>
            <input type="text" id="adrs" name="adrs" required><br><br>-->
            <label for="email">電子信箱:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="account">您的帳號:</label>
            <input type="text" id="account" name="account" required><br><br>
            <label for="pwd">您的密碼:</label>
            <input type="password" id="pwd" name="pwd" minlength="8" required><br><br>
            <input type="submit" name="input" value="註冊">

        </form>
    </div>
</body>
<?php
  if(!empty($_POST["input"])){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          if (empty($_POST["name"])) {
            echo "<br>",'。請輸入姓名', "<br>";
          } else {
            $name = test_input($_POST["name"]);
          }

          if (empty($_POST["phone"])) {
            echo "<br>",'。請輸入電話', "<br>";
          } else {
            $phone = test_input($_POST["phone"]);
          }
        
          /*if (empty($_POST["adrs"])) {
            echo "。請輸入地址", "<br>";
          } else {
            $phone = test_input($_POST["adrs"]);
          }*/

          if (empty($_POST["email"])) {
            echo "。請輸入信箱", "<br>";
          } else {
            $email = test_input($_POST["email"]);
          }

          if (empty($_POST["account"])) {
            echo "。請輸入帳號", "<br>";
          } else {
            $account = test_input($_POST["account"]);
          }

          if (empty($_POST["pwd"])) {
            echo "。請輸入密碼", "<br>";
          } else {
            $pwd = test_input($_POST["pwd"]);
          }
      }
   }
        
          function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

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

      if(isset($name) AND isset($phone) AND isset($email) AND isset($account) AND isset($pwd)){
        //$sql = "UPDATE animal SET A_id='Doe',species='$_GET['newspecies']', newsex='$_GET['newsex']' WHERE id=2";
        $sql = "INSERT INTO customer(C_name,phoneNumber,email,account,password) VALUES('$name','$phone','$email','$account','$pwd')";
        $result = mysqli_query($conn, $sql);
        if($result){
          echo "<script>alert('註冊成功!');location.href='http://localhost/php_example/login.php';</script>";
        }else{
          echo"<script>alert('該用戶已註冊過了,請直接登錄');location.href='http://localhost/php_example/login.php';</script>";
        }
        
      } 
      else {
        if(!empty($_POST["input"])){
          if($_SERVER["REQUEST_METHOD"] == "POST"){
           echo "error<br>";
          }
        }
      }
      
      
    ?>
