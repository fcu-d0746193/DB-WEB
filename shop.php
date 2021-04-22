<!DOCTYPE html>
<html>

<head>
  <title>觀光牧場</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="../css/style.css">
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
  <style>
    nav {
      font-family: "微軟正黑體", "Microsoft JhengHei", arial, helvetica, sans-serif;
    }

    .img {
      margin-left: auto;
      margin-right: auto;
    }

    .itemtext {
      color: #e97532;
      padding: 10px, 10px;
      text-align: center;
    }
  </style>
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
  <section class="container" style="margin-top: 90px; margin-bottom: 150px;">
    <div class="row">
      <div class="col-12 col-xs-6 col-md-6">
        <img class="img-fluid img-thumbnail" src="../img/商店/梨山茶-600x450.jpg">
        <h3 class="itemtext mt-6 col-md-12">牛奶(240ml)</h3>
        <p1><h6></h6>價格:NT$ 35元/瓶</p1>
        <div class="w-100"></div>
        <p2><a href="shop_P1.php">閱讀更多 →</a></p2>
      </div>
    
      <div class="col-12 col-xs-6 col-md-6">
        <img class="img-fluid img-thumbnail" src="../img/商店/梨山蜜李.jpg">
        <h3 class="itemtext mt-6 col-md-12">羊奶(240ml)</h3>
        <p1><h6>價格:NT$ ˋ30元/盒</h6></p1>
        <div class="w-100"></div>
        <p2><a href="shop_P2.php">閱讀更多 →</a></p2>
      </div>
      <div class="w-100"></div>
      <div class="col-12 col-xs-4 col-md-6">
        <img class="img-fluid img-thumbnail" src="../img/商店/梨山蜜梨.jpg">
        <h3 class="itemtext mt-6 col-md-12">羊毛(300g)</h3>
        <p1><h6>價格:NT$ 50元/盒</h6></p1>
        <div class="w-100"></div>
        <p2><a href="shop_P3.php">閱讀更多 →</a></p2>
      </div>
    
      <div class="col-12 col-xs-4 col-md-6">
        <img class="img-fluid img-thumbnail" src="../img/商店/蜜蘋果.jpg">
        <h3 class="itemtext mt-6 col-md-12">優格</h3>
        <p1><h6>價格:NT$ 25元/個</h6></p1>
        <div class="w-100"></div>
        <p2><a href="shop_P4.php">閱讀更多 →</a></p2>
      </div>
    </div>
  </section>
  
  <button class="bg-info" onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

  <script src="../js/topButton.js"></script>
  <footer class="page-footer bg-info">
      <div class="footer-copyright text-center py-3">2020</div>
  </footer>
</body>

</html>