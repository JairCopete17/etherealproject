<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<link rel="icon" type="image/svg+xml" href="./images/logo.webp" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Ethereal</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="./css/main.css">
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script type="module" src="./js/main.js"></script>
		<script type="module" src="./js/createChart.js"></script>
		<script type="module" src="./js/createMultipleChart.js"></script>
	</head>
	<body>
		<header>
			<img src="./images/logo.webp" alt="Logo" id="logo">
			<h1 class="header-title">Ethereal</h1>
			<nav>
				<ul class="header-pages">
					<li><a href="./index.php" class="header_titles">Home</a></li>
					<li><a href="./pages/news/news.html" class="header_titles">News</a></li>
					<li><a href="./pages/learn/learn.html" class="header_titles">Learn</a></li>
					<li><a href="./pages/portfolio/portfolio.html" class="header_titles">Portfolio</a></li>
				</ul>
				<ul class="header-control">
					<li class="header-control_special">
						<a href="#signin" class="header_titles">Iniciar sesión</a>
						<article id="signin" class="sign-in">
							<div class="sign-in_box">
								<a href="#" class="sign-in_close">X</a>
								<?php
								if(isset($_REQUEST['Login'])) {
									include('./php/opendb.php');
									$email = $_REQUEST['signin-email'];
									$code = $_REQUEST['signin-code'];
									$readregistro = "SELECT * from usuarios WHERE email = '$email' AND id = '$code'";
									$response = $db -> query($readregistro);
									$emailfetch = $response -> fetch_array();

									if ($emailfetch == "") { echo "<h3 class="."sign-in_alert".">Verifica tus datos para ingresar a Ethereal.</h3>"; }
									else if ($emailfetch['admin'] == 1) { header("Location: ./php/admin/admin.php"); }
									else if ($emailfetch['admin'] == 0) { header("Location: ./php/buy/buy.php"); }

									include('./php/closedb.php');
								}
								?>
								<h2>Inicia sesión en Ethereal</h2>
								<p>Para verificar tu sesión, será necesario que hayas recibido tu codigo de invitado.</p>
								<form action="" method="post" class="sign-in_form">
									<label for="signin-email">Correo</label>
									<input type="email" name="signin-email" placeholder="Digite su correo electronico" required>
									<label for="signin-code">Codigo de invitación</label>
									<input type="number" name="signin-code" placeholder="888" required>
									<input type="submit" name="Login" value="Inicia sesión">
								</form>
								<form action="./php/recover_password/recover_password.php" method="post" class="sign-in_lostpass">
									<input type="submit" value="¿Olvidaste tu codigo de invitación?">
								</form>
							</div>
						</article>
					</li>
					<li class="header-control_special">
						<a href="#signup" class="sign-up_title header_titles">Registrarse</a>
						<article id="signup" class="sign-up">
							<div class="sign-up_box">
								<a href="#" class="sign-up_close">X</a>
								<?php
								if(isset($_REQUEST['Register'])) {
									include('./php/opendb.php');
									$id = rand(1, 1000);
									$nombre = $_REQUEST['signup-nombre'];
									$apellido = $_REQUEST['signup-apellido'];
									$email = $_REQUEST['signup-email'];
									$direccion = $_REQUEST['signup-direccion'];
									$telefono = $_REQUEST['signup-telefono'];
									$btcaddress = $_REQUEST['signup-btc-address'];

									$createregistro = "INSERT INTO usuarios(id, nombre, apellido, email, direccion, telefono, btcaddress, admin)
                              VALUES ('$id', '$nombre', '$apellido', '$email', '$direccion', '$telefono', '$btcaddress', '0')";
									$response = $db -> query($createregistro);

									if (!$response) { echo "<p id="."sign-up_alert".">Error registrandote. Intenta de nuevo.</p>"; }
            				else { echo "<p id="."sign-up_success".">Registro exitoso. Tu codigo de invitación es: " . $id . "</p>"; }

									include('./php/closedb.php');
								}
								?>
								<h2>Crea tu cuenta en Ethereal</h2>
								<p>Para verificar tu sesión, será necesario que hayas recibido tu codigo de invitado.</p>
								<section class="sign-up_sect">
									<form action="" method="post" class="sign-up_form">
										<article class="sgnup-nombre">
											<label for="signup-nombre">Nombre</label>
											<input type="text" name="signup-nombre" placeholder="Escriba su nombre" required>
										</article>
										<article class="sgnup-apellido">
											<label for="signup-apellido">Apellido</label>
											<input type="text" name="signup-apellido" class="signup-apellido" placeholder="Escriba su apellido" required>
										</article>
										<article class="sgnup-email">
											<label for="signup-email">Correo</label>
											<input type="email" name="signup-email" placeholder="Digite su correo electronico" required>
										</article>
										<article class="sgnup-direccion">
											<label for="signup-direccion">Direccion</label>
											<input type="text" name="signup-direccion" class="signup-direccion" placeholder="Escriba su dirección" required>
										</article>
										<article class="sgnup-telefono">
											<label for="signup-telefono">Telefono</label>
											<input type="number" name="signup-telefono" class="signup-telefono" placeholder="Digite su numero" required>
										</article>
										<article class="sgnup-btc-address">
											<label for="signup-btc-address">Crypto wallet</label>
											<input type="text" name="signup-btc-address" id="signup-btc-address" placeholder="Digite su dirección de BTC">
										</article>
										<input type="submit" name="Register" value="Registrate" class="sgnup-submit">
									</form>
								</section>
							</div>
						</article>
					</li>
				</ul>
			</nav>
		</header>
		<section class="hero">
			<article class="hero_box">
				<div class="hero_box-img">
					<img src="./images/hero.png" alt="Hero" class="hero-image">
				</div>
			</article>
			<h1 class="hero-title">Inicia tu camino al Metaverso</h1>
		</section>
		<section class="cards">
			<h1 class="cards-title">Conoce los tokens mas influyentes en el mercado</h1>
			<section class="cryptocurrencies">
				<h2 class="tokens-title">Cryptocurrencies</h2>
				<section class="tokens-cards">
					<article class="cc_card">
						<div class="cc_card-main">
							<div class="cc_card-name">
								<div>
									<img src="" alt="Bitcoin's logo" id="bitcoin-image">
									<a href="" id="bitcoin-link"><h2>Bitcoin</h2></a>
								</div>
								<p id="bitcoin-id">BTC</p>
							</div>
							<div class="cc_card-chart">
								<canvas id="bitcoin-chart" class="cc_card-basic-chart"></canvas>
							</div>
						</div>
						<div class="cc_card-activity">
							<div>
								<p class="cc_card-subtitle">Marketcap</p>
								<p class="cc_card-price" id="bitcoin-marketcap"></p>
							</div>
							<div>
								<p class="cc_card-subtitle">Price</p>
								<p class="cc_card-price" id="bitcoin-price"></p>
							</div>
							<div>
								<p class="cc_card-subtitle">24h %</p>
								<p id="bitcoin-change"></p>
							</div>
						</div>
					</article>
					<article class="cc_card" id="eth-card">
						<div class="cc_card-main">
							<div class="cc_card-name">
								<div>
									<img src="" alt="Ethereum's logo" id="ethereum-image">
									<a href="" id="ethereum-link"><h2>Ethereum</h2></a>
								</div>
								<p id="ethereum-id">ETH</p>
							</div>
							<div class="cc_card-chart">
								<canvas id="ethereum-chart" class="cc_card-basic-chart"></canvas>
							</div>
						</div>
						<div class="cc_card-activity">
							<div>
								<p class="cc_card-subtitle">Marketcap</p>
								<p class="cc_card-price" id="ethereum-marketcap"></p>
							</div>
							<div>
								<p class="cc_card-subtitle">Price</p>
								<p class="cc_card-price" id="ethereum-price"></p>
							</div>
							<div>
								<p class="cc_card-subtitle">24h %</p>
								<p id="ethereum-change"></p>
							</div>
						</div>
					</article>
					<article class="cc_card" id="sol-card">
						<div class="cc_card-main" id="sol_card-main">
							<div class="cc_card-name" id="sol_card-name">
								<div>
									<img src="" alt="Solana's logo" id="solana-image">
									<a href="" id="solana-link"><h2>Solana</h2></a>
								</div>
								<p id="solana-id">SOL</p>
							</div>
							<div class="cc_card-chart" id="sol_card-chart">
								<canvas id="solana-chart" class="cc_card-basic-chart"></canvas>
							</div>
						</div>
						<div class="cc_card-activity" id="sol_card-activity">
							<div>
								<p class="cc_card-subtitle">Price</p>
								<p class="cc_card-price" id="solana-price"></p>
							</div>
							<div>
								<p class="cc_card-subtitle">24h %</p>
								<p id="solana-change"></p>
							</div>
						</div>
					</article>
				</section>
			</section>
			<section class="defi">
				<h2 class="tokens-title">DeFi</h2>
				<article class="defi-box">
					<article class="defi_card">
						<div class="defi_card-chart">
							<canvas id="defi-chart" class="defi_card-basic-chart"></canvas>
						</div>
					</article>
					<article class="defi-cc_cards">
						<article class="defi-cc_card">
							<div>
								<img src="" alt="Terra's logo" id="terra-image">
								<a href="" id="terra-link"><h2>Terra</h2></a>
							</div>
							<div class="defi-cc_card-activity">
								<p class="cc_card-subtitle">Price</p>
								<p class="defi-cc_card-price" id="terra-price"></p>
								<p class="cc_card-subtitle">24h %</p>
								<p class="defi-cc_card-change" id="terra-change"></p>
							</div>
						</article>
						<article class="defi-cc_card">
							<div>
								<img src="" alt="Uniswap's logo" id="uniswap-image">
								<a href="" id="uniswap-link"><h2>Uniswap</h2></a>
							</div>
							<div class="defi-cc_card-activity">
								<p class="cc_card-subtitle">Price</p>
								<p class="defi-cc_card-price" id="uniswap-price"></p>
								<p class="cc_card-subtitle">24h %</p>
								<p class="defi-cc_card-change" id="uniswap-change"></p>
							</div>
						</article>
						<article class="defi-cc_card">
							<div>
								<img src="" alt="Chainlink's logo" id="chainlink-image">
								<a href="" id="chainlink-link"><h2>Chainlink</h2></a>
							</div>
							<div class="defi-cc_card-activity">
								<p class="cc_card-subtitle">Price</p>
								<p class="defi-cc_card-price" id="chainlink-price"></p>
								<p class="cc_card-subtitle">24h %</p>
								<p class="defi-cc_card-change" id="chainlink-change"></p>
							</div>
						</article>
						<article class="defi-cc_card">
							<div>
								<img src="" alt="PancakeSwap's logo" id="pancakeswap-image">
								<a href="" id="pancakeswap-link"><h2>PancakeSwap</h2></a>
							</div>
							<div class="defi-cc_card-activity">
								<p class="cc_card-subtitle">Price</p>
								<p class="defi-cc_card-price" id="pancakeswap-price"></p>
								<p class="cc_card-subtitle">24h %</p>
								<p class="defi-cc_card-change" id="pancakeswap-change"></p>
							</div>
						</article>
						<article class="defi-cc_card">
							<div>
								<img src="" alt="THORChain's logo" id="thorchain-image">
								<a href="" id="thorchain-link"><h2>THORChain</h2></a>
							</div>
							<div class="defi-cc_card-activity">
								<p class="cc_card-subtitle">Price</p>
								<p class="defi-cc_card-price" id="thorchain-price"></p>
								<p class="cc_card-subtitle">24h %</p>
								<p class="defi-cc_card-change" id="thorchain-change"></p>
							</div>
						</article>
					</article>
				</article>
			</section>
			<section class="nft">
				<h2 class="tokens-title">NFT</h2>
				<section class="nft-cards">
					<article class="nft_card" id="bayc_card">
						<h3>Bored Ape Yatch Club #2087</h3>
						<img src="./images/bayc_2087.png" alt="Bored Ape Yatch Club NFT">
						<p>Highest sale price <strong>Ξ 769</strong></p>
					</article>
					<article class="nft_card" id="cryptopunk_card">
						<h3>Cryptopunk #9998</h3>
						<img src="./images/cryptopunk_9998.png" alt="Cryptopunk NFT">
						<p>Highest sale price <strong>Ξ 124.457,06</strong></p>
					</article>
					<article class="nft_card" id="doodles_card">
						<h3>Doodles #316</h3>
						<img src="./images/doodle_316.png" alt="Doodles NFT">
						<p>Highest sale price <strong>Ξ 100</strong></p>
					</article>
					<article class="nft_card" id="cool-cat_card">
						<h3>Cool cat #1490</h3>
						<img src="./images/cool-cat_1490.png" alt="Cool Cat NFT">
						<p>Highest sale price <strong>Ξ 320</strong></p>
					</article>
				</section>
			</section>
		</section>
		<section class="cta">
			<article class="cta-box">
				<h2>Crea tu propio portfolio</h2>
				<a href="#portfolio">
					Crea ahora
					<img src="./images/create.svg" />
				</a>
			</article>
		</section>
		<section class="learn">
			<h2>Aprende</h2>
			<p>Descubre acerca de la Web3, el futuro de la descentralización y toda las cosas que depara el mundo crypto.</p>
			<article class="learn-card stretch">
				<p class="learn-card_subtitle">Crypto basis</p>
				<figure class="coin-stack">
					<img src="./images/coin.svg" class="coin-stack-first" />
					<img src="./images/coin.svg" class="coin-stack-second" />
					<img src="./images/coin.svg" class="coin-stack-third" />
					<img src="./images/coin.svg" class="coin-stack-fourth" />
					<img src="./images/coin.svg" class="coin-stack-fifth" />
					<img src="./images/special_coin.svg" class="coin-stack-special" />
				</figure>
				<article>
					<h3 class="learn-card_title">Blockchain</h3>
					<p class="learn-card_text">Un sistema de contabilidad distribuida. Una secuencia de bloques, o unidades de información digital, almacenada en una base de datos pública.</p>
					<a href="#" class="learn-card_link">Aprende más <img src="./images/ArrowRight.svg"></a>
				</article>
			</article>
			<article class="learn-card wide">
				<p class="learn-card_subtitle">Finance</p>
				<img src="./images/planet.svg" class="planet" />
				<article>
					<h3 class="learn-card_title">DeFi</h3>
					<p class="learn-card_text">Finanzas descentralizadas. Un movimiento que fomenta alternativas a las formas tradicionales y centralizadas de servicios financieros.</p>
					<a href="#" class="learn-card_link">Aprende más <img src="./images/ArrowRight.svg"></a>
				</article>
			</article>
			<article class="learn-card wider">
				<p class="learn-card_subtitle">New gaming</p>
				<img src="./images/planet-graph.svg" class="planet-graph" />
				<article>
					<h3 class="learn-card_title">GameFi (P2E)</h3>
					<p class="learn-card_text">Hace referencia a juegos que están diseñados con aspectos económicos y financieros de blockchain y criptomonedas, lo que permite a los jugadores ejercer un control total sobre sus activos en el juego para generar ingresos. </p>
					<a href="#" class="learn-card_link">Aprende más <img src="./images/ArrowRight.svg"></a>
				</article>
			</article>
		</section>
		<section class="community">
			<article class="community-box">
				<h2>Conoce a la comunidad global de Ethereal.</h2>
				<p>Unete a una comunidad en rápido crecimiento para innovadores conectados en todo el mundo, construyendo la nueva era de Internet.</p>
				<a href="discord.gg">Comunidad <img src="./images/ArrowRight.svg" alt="Flecha hacia la derecha"></a>
			</article>
			<article class="community-list">
				<ul>
					<li>
						<h3><a href="discord.gg">Discord <img src="./images/ArrowRight.svg" alt="Flecha hacia la derecha"></a></h3>
						<p>Participa y charla con la comunidad mundial en Discord. ¿Tiene preguntas técnicas sobre Ethereal? Pregúntale a un desarrollador en Discord.</p>
					</li>
					<li>
						<h3><a href="twitter.com/">Twitter <img src="./images/ArrowRight.svg" alt="Flecha hacia la derecha"></a></h3>
						<p>Sigue a @ethereal para leer las últimas noticias y actualizaciones de todo el ecosistema.</p>
					</li>
					<li>
						<h3><a href="github.com/">Github <img src="./images/ArrowRight.svg" alt="Flecha hacia la derecha"></a></h3>
						<p>¿Está pensando en construir con nosotros o estás interesado en asuntos de desarrolladores? Únete a la discusión.</p>
					</li>
				</ul>
			</article>
		</section>
		<footer>
			<article>
				<img src="./images/wsb-astronaut.png" alt="Ethereal astronaut" />
				<form action="mailto:newsletter@ethereal.com" method="POST">
					<input type="email" name="email" placeholder="Ingrese su email para mantenerse actualizado">
					<input type="submit" value="Enviar">
				</form>
			</article>
			<ul>
				<li><a href="index.php">Ethereal</a></li>
				<li><a href="#">Portfolio</a></li>
				<li><a href="#">Learn</a></li>
				<li><a href="#">Build</a></li>
				<li><a href="#">Explore</a></li>
				<li><a href="#">Participate</a></li>
				<li><a href="#">Resources</a></li>
			</ul>
			<article class="back-footer">
				<article>
					<img src="./images/logo.webp" alt="Logo" class="footer-logo">
					<h4>Ethereal</h4>
				</article>
				<article>
					<p>La información fue provista por</p>
					<img src="./images/coingecko.svg" alt="CoinGecko Logo" class="coingecko-logo">
				</article>
			</article>
		</footer>
	</body>
</html>
