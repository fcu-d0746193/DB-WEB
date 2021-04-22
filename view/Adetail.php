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
            <li><a class="nav-link" href="feeder.php">動物資訊</a></li>
                <li><a class="nav-link" href="order.php">原料資訊</a></li>
                <li><a class="nav-link" href="order.php">通知</a></li>
                <li><a class="nav-link" href="logout.php">登出</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>
<form action="Adetail.php" method="get">
    <label>花費：</label><input type="text" name="update-cost" ><br>
    <label>狀況：</label><input type="text" name="update-health" ><br>
    <label>產量：</label><input type="text" name="update-yield" ><br>
    <input type="submit" name="update" value="更新">
</form>
<?php session_start();
  if($_SESSION['username'] == null){ 
    //header("Location: xxxx.com");
    echo '<meta http-equiv=REFRESH CONTENT=2;url=http://localhost/php_example/main.php>';  
    echo "<script>history.forward()</script>";
    exit(); 
   }

  if(isset($_GET['A_id'])){
    $_SESSION['Aid'] = $_GET['A_id'];
  }
  

  if(!empty($_GET["update"])){
    if($_SERVER["REQUEST_METHOD"] == "GET"){

      $upcost = test_input($_GET["update-cost"]);
      $uphealth = test_input($_GET["update-health"]);
      $upyield = test_input($_GET["update-yield"]);
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
    //$id = $_SESSION[ "id" ];
    if(!empty($_GET["update"])){
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      if($upcost != ""){
        $sql = "UPDATE animal SET cost='$upcost' WHERE A_id='{$_SESSION["Aid"]}'";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
      }
      if($uphealth != ""){
        $sql = "UPDATE animal SET health='$uphealth' WHERE A_id='{$_SESSION["Aid"]}'";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
      }
      if($upyield != ""){
        $sql = "UPDATE animal SET yield='$upyield' WHERE A_id='{$_SESSION["Aid"]}'";
        $result = mysqli_query($conn, $sql) or die('MySQL query error');
      }
    }
    }


    if(!empty($upcost) or !empty($uphealth) or !empty($upyield) ){
      echo "更新成功!!!";
      $sql = "SELECT * FROM animal where A_id = '{$_SESSION["Aid"]}'";
      $result = mysqli_query($conn, $sql) or die('MySQL query error');
      while($row = mysqli_fetch_array($result)){
        echo  $row['species'] ,$row['sex'] ,$row['cost'] ,$row['health'] ,$row['yield'], "<br>";
      }
    }

    ?>
    <form action="Adetail.php" method="post">
    <p>輸入文字描述：</p><textarea id="text" name="text" rows="4" cols="50"></textarea>
      <input type="submit" name="input" value="輸入">
    </form>

  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $set = $_POST["text"];
    echo $set;
    if($set != ""){
      $sql = "INSERT INTO descriptions(A_id,destext) VALUES('{$_SESSION['Aid']}','$set')";
      $result = mysqli_query($conn, $sql);

      $set = "";

    }else{
      echo "請輸入資訊";
    }
  }


  echo $_SESSION[ "Aid" ],"<br>事件描述 :  <br>";
  $sql = "SELECT * FROM descriptions where A_id = '{$_SESSION["Aid"]}'";
  $result = mysqli_query($conn, $sql) or die('MySQL query error');
  while($row = mysqli_fetch_array($result)){
   echo  $row['destext'] ,$row['time'] ,"<br>";
  }

  ?>