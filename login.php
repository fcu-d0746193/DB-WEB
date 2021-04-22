<div id="shop-title-div">
    <h1 id="title-h1">登入</h1>
  </div>

  <form action="login.php" method="post">
    <div class="container"><br>
      <label><input type="radio" name="person" value="c"checked>客戶</label>
      <label><input type="radio" name="person" value="e">員工</label>
      <br><br>
      <label for="account">帳號: </label>
      <input type="text" id="user" name="user" ><br><br>
      <label for="pwd">密碼:</label>
      <input type="password" id="pwd" name="pwd" minlength="8" ><br><br>
      <input type="submit" class="button button1"  name="log" value="登入">
    </div>
  </form>

  <form action="sign.php" method="post">
    <div class="context">
      <p id="title-p">尚未註冊?
        <button type="buttom" class="button button2" formaction="sign.php" value="login">註冊</button></p>
    </div>
  </form>
  <?php session_start();  
//require  'session.php';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $perosn = $_POST['person'];
    if(!empty($_POST['log'])){
      if (empty($_POST["user"])) {
        echo '請輸入帳號', "<br>";
        $_SESSION['username']="";
      } else {
        $username = test_input($_POST["user"]);
        $_SESSION['username'] = $username;
      }
  
      if (empty($_POST["pwd"])) {
        echo "請輸入密碼", "<br>";
        $_SESSION['password'] = "";
      } else {
        $password = test_input($_POST["pwd"]);
        $_SESSION['password'] = $password;
      }
    }
    else{
      echo "請輸入帳號密碼";
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


    if(!empty($_SESSION['password']) AND !empty($_SESSION['username']) ){
      if(!empty($perosn)){
      if($perosn == "c"){
        $sql = "SELECT C_name, C_id FROM customer where account = '{$_SESSION[ "username" ]}' and password = '{$_SESSION[ "password" ]}';";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
        $row = mysqli_fetch_array($result);
        if(isset($row['C_name'])){
          //echo "登入成功 Hi ";
          //echo $row['C_name']."<p>";
          $_SESSION["id"] = $row['C_id'];
          $_SESSION["Name"] = $row['C_name'];
         
          echo "<script>alert('登入成功');location.href='http://localhost/php_example/shop.php';</script>";
        }
        else{
          echo"<script>alert('帳號或密碼錯誤')</script>";
        }
      }
      else if($perosn == "e"){
          $sql = "SELECT E_name, E_id, job_Type FROM employee where account = '{$_SESSION[ "username" ]}' and password = '{$_SESSION[ "password" ]}';";
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
          $row = mysqli_fetch_array($result);
          if(isset($row['E_name'])){
            $_SESSION["id"] = $row['E_id'];
            $_SESSION["Name"] = $row['E_name'];
            if($row['job_Type'] == "feeder"){
              echo "<script>alert('登入成功');location.href='http://localhost/php_example/view/feeder.php';</script>";
            //echo "登入成功 Hi ";
            //echo $row['E_name']."<p>";
            }
            else if($row['job_Type'] == "worker"){
              echo "<script>alert('登入成功');location.href='http://localhost/php_example/view/worker.php';</script>";
            //echo "登入成功 Hi ";
            //echo $row['E_name']."<p>";
            }
            else if($row['job_Type'] == "warehouse"){
              echo "<script>alert('登入成功');location.href='http://localhost/php_example/view/Warehouse.php';</script>";
            //echo "登入成功 Hi ";
            //echo $row['E_name']."<p>";
            }
          }
          else{
            echo"<script>alert('帳號或密碼錯誤')</script>";
          }
      }
    }
  }
?>




 


