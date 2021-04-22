<?PHP session_start();
  session_destroy();
  echo "<script>alert('登出成功!');location.href='http://localhost/php_example/main.php';</script>";
  "<script>history.forward()</script>";
?>
<button type="buttom" class="button" formaction="main.php" value="login">註冊</button></p>