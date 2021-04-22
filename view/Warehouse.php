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
                <li><a class="nav-link" href="Pdetail.php">產品資訊</a></li>
                <li><a class="nav-link" href="Warehouse.php">訂單資訊</a></li>
                <li><a class="nav-link" href="order.php">通知</a></li>
                <li><a class="nav-link" href="logout.php">登出</a></li>
            </ul>
        </div>
    </nav>
</body>
    <br><br><br>
      <label>選擇索引條件：</label>
      <select id="search" name="select" onchange="change(value)">
        <option id=a value="select-t" >---</option>
        <option id=b value="select-a" >全部</option>
        <option id=c value="select-b" >已完成訂單</option>
        <option id=d value="select-c" >未完成訂單</option>
      </select>
       <script>

        function change(value){
            document.getElementById("search").value;
            //document.getElementById("search")=value;
            location.href="http://localhost/php_example/view/Warehouse.php?value=" +value;
               //$Ssql = "DELETE FROM shoppingcart WHERE P_id = '$value';";
               //mysqli_query($conn, $Ssql) or die('MySQL query error');
        }

       </script>
       <br>
       <br>

<?php session_start();
    $dbhost = '127.0.0.1';
    $dbuser = 'hj';
    $dbpass = 'test1234';
    $dbname = 'testdb';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
    $_SESSION['conn'] = $conn;
    mysqli_query($conn, "SET NAMES 'utf8'");
    mysqli_select_db($conn, $dbname);
    //echo $_SESSION[ "password" ];
    $conn = $_SESSION['conn'];
    if(isset($_GET['finish'])){
      $sql = "UPDATE orders SET flag = 'F' where O_id = '{$_GET['finish']}';";
      $result = mysqli_query($conn, $sql) or die('MySQL query error');
      

    }
    if(isset($_GET['value'])){
        if($_GET['value'] == "select-a"){
            $sql = "SELECT * FROM orders ";
            //$sql = "SELECT * FROM customer where account = '$username' and password =  '$password';";
            $result = mysqli_query($conn, $sql) or die('MySQL query error');
     
              /*mysqli_connect("localhost","hj","test1234");
               mysqli_select_db("testdb");
            //Query the database for user
             $result = mysql_query("select * from users where username = '$username' and password = '$password'")//要改
             or die ("Failed to query database".mysql_error());
              $row = mysql_fetch_array($result);*/
            echo "全部訂單","<p>";
            echo "訂單編號  ", "客戶編號  ", "建立時間  ","<p>";
            while($row = mysqli_fetch_array($result)){
               $tmp=$row['O_id'];
               echo "<a href=Odetail.php?O_id=$tmp>".$row['O_id']."</a>";
               echo "     ", $row['C_id'],"    ", $row['date'],"<p>";
               echo "<br>";
            }
        }
        else if($_GET['value'] == "select-b"){
            $sql = "SELECT * FROM orders where flag = 'F' ;";
            $result = mysqli_query($conn, $sql) or die('MySQL query error');
            echo "已完成訂單","<p>";
            echo "訂單編號", "客戶編號", "建立時間","<p>";
            while($row = mysqli_fetch_array($result)){
               $tmp=$row['O_id'];
               echo "<a href=Odetail.php?O_id=$tmp>".$row['O_id']."</a>";
               echo "     ", $row['C_id'],"    ", $row['date'],"<p>";
               echo "<br>";
            }
        } 
        else if($_GET['value'] == "select-c"){
            $sql = "SELECT * FROM orders where flag IS NULL ;";
            $result = mysqli_query($conn, $sql) or die('MySQL query error');
            echo "未完成訂單","<p>";
            echo "訂單編號", "客戶編號", "建立時間","<p>";
            while($row = mysqli_fetch_array($result)){
               $tmp = $row['O_id'];
               echo "<a href=Odetail.php?O_id=$tmp>".$row['O_id']."</a>";
               echo "     ", $row['C_id'],"    ", $row['date'],"<p>";
?>
       <input type="button"  class="button button2" value="完成" onclick="finish('<?php echo $tmp;?>')">
       <script>

        function finish(string){
            location.href="Warehouse.php?finish=" +string;
            alert("確認完成");
               //$Ssql = "DELETE FROM shoppingcart WHERE P_id = '$value';";
               //mysqli_query($conn, $Ssql) or die('MySQL query error');
        }
       </script>
<?php
               echo "<br>";
            }
        } 
    }
    ?>