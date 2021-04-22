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
                <li><a class="nav-link" href="Mdetail.php">原料資訊</a></li>
                <li><a class="nav-link" href="order.php">通知</a></li>
                <li><a class="nav-link" href="logout.php">登出</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>

    <form action="Mdetail.php" method="get">
    <label>生牛奶：</label><input type="text" name="update-Rmilk" ><br>
    <label>生羊奶：</label><input type="text" name="update-Gmilk" ><br>
    <label>生羊毛：</label><input type="text" name="update-wool" ><br>
    <input type="submit" name="update" value="更新">
</form>
<?php session_start();
  if(!empty($_GET["update"])){
    if($_SERVER["REQUEST_METHOD"] == "GET"){

      $upRmilk = test_input($_GET["update-Rmilk"]);
      $upGmilk = test_input($_GET["update-Gmilk"]);
      $upwool = test_input($_GET["update-wool"]);
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
        if($upRmilk != ""){
          $sql = "SELECT Rmilk FROM material ";
          $sql = "UPDATE material SET Rmilk='$upRmilk' ";
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
        }
        if($upGmilk != ""){
          $sql = "UPDATE material SET Gmilk='$upGmilk'";
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
        }
        if($upwool != ""){
          $sql = "UPDATE material SET wool='$upwool' ";
          $result = mysqli_query($conn, $sql) or die('MySQL query error');
        }
      }
    }


      echo "<br>現在資料: <br>";
      echo "生牛乳 生羊乳 羊毛";
      $sql = "SELECT * FROM material ";
      $result = mysqli_query($conn, $sql) or die('MySQL query error');
      while($row = mysqli_fetch_array($result)){
        echo "<br>", $row['Rmilk'],"    " ,$row['Gmilk'],"      " ,$row['wool'], "     <br>";
      }

  ?>