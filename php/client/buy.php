<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="../../images/logo.webp" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Compra | Ethereal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/buy-main.css">
    <script type="module" src="../../js/checkShoppingCart.js"></script>
  </head>
  <body>
    <header>
      <img src="../../images/logo.webp" alt="Logo" id="logo">
      <nav>
        <ul class="header-pages">
					<li><a href="../../index.php"  class="header_titles">Home</a></li>
          <li><a href="../../pages/news/news.html" class="header_titles">News</a></li>
          <li><a href="../../pages/learn/learn.html" class="header_titles">Learn</a></li>
          <li><a href="../../pages/portfolio/portfolio.html" class="header_titles">Portfolio</a></li>
        </ul>
        <ul class="header-control">
          <li class="header-control_special"><a href="#"><img src="../../images/Profile.svg" alt="Profile" class="header-control_icons"></a></li>
        </ul>
      </nav>
    </header>
		<section class="buy_dashboard">
      <?php echo "<h1>Bienvenido, " . $_SESSION['username'] .".</h1>"; ?>
      <p>Ethereal esta comprometido en diseñar las mejores soluciones para mejorar tu experiencia en la <em>Web 3.0</em>. <br>Con ello, te ofrecemos la compra de <b>licencias limitadas</b> para nuestros productos.</p>
		</section>
    <form action="./buy.php" method="POST" class="order-form">
      <section class="buy_product">
        <h2>Selecciona tu producto a comprar:</h2>
        <article>
          <select name="productselect" id="product-select">
            <option value="null">Seleccione uno</option>
            <option value="portf">Portfolio tracker</option>
            <option value="nft">NFT Collection dashboard</option>
            <option value="hot">ETH Hot wallet</option>
            <option value="ai">AI Cryptopredictions</option>
          </select>
          <p id="product-value"></p>
        </article>
      </section>
      <section class="buy_product-quantity">
        <h2>Elige la cantidad de licencias a comprar:</h2>
        <input type="number" max="10" name="product-quantity" id="product-quantity" placeholder="Maximo 10 licencias por compra">
      </section>
      <section class="buy_method">
        <h2>Selecciona tu metodo de pago:</h2>
        <select name="methodselect" id="method-select">
          <option value="BTC">Bitcoin</option>
          <option value="ETH">Ethereum</option>
          <option value="PSE">PSE</option>
          <option value="visa">Visa</option>
          <option value="Mastercard">Mastercard</option>
        </select>
      </section>
      <section class="buy_ship">
        <article>
          <h2>Valor total de la compra </h2>
          <h3 id="product-total"></h3>
        </article>
        <input type="submit" name="Comprar" value="Compra ahora">
      </section>
    </form>
    <?php
    if (isset($_REQUEST['Comprar'])) {
      include ('../opendb.php');
      $userid = $_SESSION['userid'];
      $username = $_SESSION['username'];
      $userlastname = $_SESSION['userlastname'];
      $product = $_REQUEST['productselect'];
      $quantity = $_REQUEST['product-quantity'];
      $method = $_REQUEST['methodselect'];

      if ($product == 'portf') { $product = 'Portfolio tracker'; }
        else if ($product == 'nft') { $product = 'NFT Collection dashboard'; }
        else if ($product == 'hot') { $product = 'ETH Hot wallet'; }
        else if ($product == 'ai') { $product = 'AI Cryptopredictions'; }


      $createorder = "INSERT INTO ordenes(orderid, userid, nombre, apellido, producto, cantidad, metodo)
                        VALUES (DEFAULT, '$userid', '$username', '$userlastname', '$product', '$quantity', '$method')";
      $response = $db -> query($createorder);

      if (!$response) { echo "<script>alert('Tu orden ha fallado.')</script>"; }
        else { echo "<script>alert('Tu orden está en tramite.')</script>"; }

      include ('../closedb.php');
    }
    ?>
    <footer>
      <ul>
        <li><a href="../../index.php">Ethereal</a></li>
        <li><a href="#">Portfolio</a></li>
        <li><a href="#">Learn</a></li>
        <li><a href="#">Build</a></li>
        <li><a href="#">Explore</a></li>
        <li><a href="#">Participate</a></li>
        <li><a href="#">Resources</a></li>
      </ul>
      <article class="back-footer">
        <article>
          <img src="../../images/logo.webp" alt="Logo" class="footer-logo">
          <h4>Ethereal</h4>
        </article>
        <article>
          <p>La información fue provista por</p>
          <img src="../../images/coingecko.svg" alt="CoinGecko Logo" class="coingecko-logo">
        </article>
      </article>
    </footer>
  </body>
</html>
