<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
		<meta name="author" content="Jair Copete" />
		<meta name="keywords" content="Ethereal, Crypto, Web3, PHP, SQL, Javascript, CSS, HTML5" />
		<meta name="description" content="Una aplicación web para rastrear sus activos digitales y cripto" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recupera tu contraseña | Ethereal</title>
    <link rel="icon" type="image/svg+xml" href="../../images/logo.webp" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/recoverpassword-main.css">
  </head>
  <body>
    <header>
      <img src="../../images/logo.webp" alt="Logo" id="logo">
      <nav>
        <ul class="header-pages">
					<li><a href="../../index.php"  class="header_titles">Home</a></li>
          <li><a href="#" class="header_titles">News</a></li>
          <li><a href="#" class="header_titles">Learn</a></li>
          <li><a href="#" class="header_titles">Portfolio</a></li>
        </ul>
        <ul class="header-control">
          <li class="header-control_special"><a href="#"><img src="../../images/Profile.svg" alt="Profile" class="header-control_icons"></a></li>
        </ul>
      </nav>
    </header>
		<section class="recoverpassword-box">
			<h1>Recupera tu codigo de invitación</h1>
			<p>Si tu correo electronico está vinculado a un codigo en nuestra base de datos, podrás acceder de nuevo a la plataforma de Ethereal.</p>
			<form action="./recover_password.php" method="POST">
					<input type="email" name="rp_email" placeholder="Digite su correo electronico">
					<input type="submit" name="Recover" value="Recuperar">
			</form>
			<article>
				<?php
				if(isset($_REQUEST['Recover'])) {
					include('../opendb.php');
					$email = $_REQUEST['rp_email'];
					$readregistro = "SELECT * from usuarios WHERE email = '$email'";
					$response = $db -> query($readregistro);
					$codigorecuperado = $response -> fetch_array();

          if ($codigorecuperado == "") { echo "<h3>Tu correo NO está vinculado a Ethereal.</h3>"; }
					else { echo "
						<p>Codigo recuperado con éxito.</p>
						<h3> Tu codigo es: ".$codigorecuperado['id']."</h3>
					"; }

          include('../closedb.php');
				}
				?>
			</article>
		</section>
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
