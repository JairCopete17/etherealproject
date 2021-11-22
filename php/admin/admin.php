<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="../../images/logo.webp" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Ethereal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/admin-main.css">
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
		<section class="control_dashboard">
      <?php echo "<h1>Bienvenido, " . $_SESSION['username'] .".</h1>"; ?>
      <article class="control-form">
      <form id="admincrud-form" action="./admin.php" method="POST">
        <section class="control-form_inputs">
        <article>
          <label for="id">Id</label>
          <input type="number" for="id" name="inp_id" class="inp_id" placeholder="888" required>
        </article>
        <article>
          <label for="nombre">Nombre</label>
          <input type="text" for="nombre" name="inp_nombre" class="inp_nombre" placeholder="Nombre" required>
        </article>
        <article>
          <label for="apellido">Apellido</label>
          <input type="text" for="apellido" name="inp_apellido" class="inp_apellido" placeholder="Apellido" required>
        </article>
        <article>
          <label for="email">Correo electronico</label>
          <input type="email" for="email" name="inp_email" class="inp_email" placeholder="correo@email.com" required>
        </article>
        <article>
          <label for="direccion">Direccion</label>
          <input type="direccion" for="text" name="inp_direccion" class="inp_direccion" placeholder="345 Direccion" required>
        </article>
        <article>
          <label for="telefono">Telefono</label>
          <input type="number" for="telefono" name="inp_telefono" class="inp_telefono" placeholder="3008881234" required>
        </article>
        <article>
          <label for="btc-address">Crypto wallet</label>
          <input type="text" for="btc-address" name="inp_btc-address" class="inp_btc-address" placeholder="Dirección de Bitcoin" required>
        </article>
        <article>
          <label for="admin">Admin</label>
          <input type="number" for="admin" name="inp_admin" class="inp_admin" max="1" placeholder="0" required>
        </article>
        </section>
        <section class="control-form_actions">
          <article>
            <input type="submit" name="Create" value="Create" class="submitcrud">
            <input type="submit" name="Read" value="Read" class="submitcrud">
            <input type="submit" name="Update" value="Update" class="submitcrud">
            <input type="submit" name="Delete" value="Delete" class="submitcrud">
          </article>
          <article>
            <span>Buscar</span>
            <select name="opt_busqparticular" class="submitcrud">
              <option value="cedula">Cedula</option>
              <option value="nombre">Nombre</option>
              <option value="apellido">Apellido</option>
              <option value="email">Email</option>
              <option value="direccion">Direccion</option>
              <option value="btc-address">Crypto wallet</option>
              <option value="admin">Admin</option>
            </select>
            <input type="search" name="inp_busqparticular" class="searchcrud">
            <input type="submit" name="Search" value="Search" class="submitcrud">
          </article>
          <article>
            <a href="#orderhistorial"><input type="button" class="orderhistorialcrud" value="Consulta ordenes"></a>
              <article id="orderhistorial" class="order-historial">
                <div class="order-historial_box">
                  <a href="#" class="order-historial_close">X</a>
                  <h2>Historial de ordenes</h2>
                  <div>
                    <p>Buscar por:</p>
                    <select form="order-form" name="orderselect" class="submitcrud">
                      <option value="id">ID</option>
                      <option value="BTC">Bitcoin</option>
                      <option value="ETH">Ethereum</option>
                      <option value="PSE">PSE</option>
                      <option value="Visa">Visa</option>
                      <option value="Mastercard">Mastercard</option>
                    </select>
                    <input type="search" form="order-form" name="idsearch" class="searchcrud">
                    <input type="submit" form="order-form" name="Historial" value="Check" class="historialcrud">
                  </div>
                  <?php
                  if(isset($_REQUEST['Historial'])) {
                    include('../opendb.php');
                    $seleccion = $_REQUEST['orderselect'];
                    $busqueda = $_REQUEST['idsearch'];

                    $searchregistro = "SELECT * from ordenes WHERE metodo = '$seleccion' ORDER BY orderid ASC";
                    if ($seleccion == 'id') { $searchregistro = "SELECT * from ordenes WHERE userid = '$busqueda' ORDER BY orderid ASC"; }
                    $response = $db -> query($searchregistro);

                    echo "
                    <table class=" . "historialdatatable" . ">
                    <thead>
                      <tr class=" . "thead-row" . ">
                        <th>OrderID</th>
                        <th>UserID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Metodo</th>
                      </tr>
                    </thead>
                    <tbody>
                    ";

                    while ($orderfetch = $response -> fetch_array()) {
                      echo "
                        <tr class="."user-row".">
                          <td>" . $orderfetch['orderid'] . "</td>
                          <td>" . $orderfetch['userid'] . "</td>
                          <td>" . $orderfetch['nombre'] . "</td>
                          <td>" . $orderfetch['apellido'] . "</td>
                          <td>" . $orderfetch['producto'] . "</td>
                          <td>" . $orderfetch['cantidad'] . "</td>
                          <td>" . $orderfetch['metodo'] . "</td>
                        </tr>
                      ";
                    }
                    echo "</tbody></table>";

                    include('../closedb.php');
                  }
                  ?>
                </div>
              </article>
          </article>
        </section>
      </form>
      <form id="order-form" action="./admin.php#orderhistorial" method="POST"></form>
      </article>
      <article class="control-table">
        <?php
        //Create
        if (isset($_REQUEST['Create'])) {
          include ('../opendb.php');
          $id = $_REQUEST['inp_id'];
          $nombre = $_REQUEST['inp_nombre'];
          $apellido = $_REQUEST['inp_apellido'];
          $email = $_REQUEST['inp_email'];
          $direccion = $_REQUEST['inp_direccion'];
          $telefono = $_REQUEST['inp_telefono'];
          $btcaddress = $_REQUEST['inp_btc-address'];
          $adm = $_REQUEST['inp_admin'];

          $createregistro = "INSERT INTO usuarios(id, nombre, apellido, email, direccion, telefono, btcaddress, admin)
                              VALUES ('$id', '$nombre', '$apellido', '$email', '$direccion', '$telefono', '$btcaddress', '$adm')";
          $response = $db -> query($createregistro);

          if (!$response) { echo "<p class="."error".">Error creando un usuario.</p>"; }
            else { echo "<p class="."ok".">Registro creado.</p>"; }

          include ('../closedb.php');
        }

        //Read
        if (isset($_REQUEST['Read'])) {
          include ('../opendb.php');
          $id = $_REQUEST['inp_id'];
          $nombre = $_REQUEST['inp_nombre'];
          $apellido = $_REQUEST['inp_apellido'];
          $email = $_REQUEST['inp_email'];
          $direccion = $_REQUEST['inp_direccion'];
          $telefono = $_REQUEST['inp_telefono'];
          $btcaddress = $_REQUEST['inp_btc-address'];
          $adm = $_REQUEST['inp_admin'];

          $readregistro = "SELECT * from usuarios
                            WHERE id = '$id'
                              AND nombre = '$nombre'
                              AND apellido = '$apellido'
                              AND email = '$email'
                              AND direccion = '$direccion'
                              AND telefono = '$telefono'
                              AND btcaddress = '$btcaddress'
                              AND admin = '$adm'";
          $response = $db -> query($readregistro);
          $resp = $response -> fetch_array();

          if (!$resp) { echo "<p class="."error".">Registro NO encontrado.</p>"; }
            else { echo "<p class="."ok".">Registro encontrado.</p>"; }

          include ('../closedb.php');
        }

        //Delete
        if (isset($_REQUEST['Delete'])) {
          include ('../opendb.php');
          $id = $_REQUEST['inp_id'];
          $nombre = $_REQUEST['inp_nombre'];
          $apellido = $_REQUEST['inp_apellido'];
          $email = $_REQUEST['inp_email'];
          $direccion = $_REQUEST['inp_direccion'];
          $telefono = $_REQUEST['inp_telefono'];
          $btcaddress = $_REQUEST['inp_btc-address'];
          $adm = $_REQUEST['inp_admin'];

          $deleteregistro = "DELETE FROM usuarios
                              WHERE id = '$id'
                                AND nombre = '$nombre'
                                AND apellido = '$apellido'
                                AND email = '$email'
                                AND direccion = '$direccion'
                                AND telefono = '$telefono'
                                AND btcaddress = '$btcaddress'
                                AND admin = '$adm'";
          $response = $db -> query($deleteregistro);

          if (!$response) { echo "<p class="."error".">Error eliminando a un usuario.</p>"; }
            else { echo "<p class="."ok".">Registro eliminado.</p>"; }

          include ('../closedb.php');
        }

        //Update
        if (isset($_REQUEST['Update'])) {
          include ('../opendb.php');
          $id = $_REQUEST['inp_id'];
          $nombre = $_REQUEST['inp_nombre'];
          $apellido = $_REQUEST['inp_apellido'];
          $email = $_REQUEST['inp_email'];
          $direccion = $_REQUEST['inp_direccion'];
          $telefono = $_REQUEST['inp_telefono'];
          $btcaddress = $_REQUEST['inp_btc-address'];
          $adm = $_REQUEST['inp_admin'];

          $updateregistro = "UPDATE usuarios
                              SET nombre = '$nombre',
                                apellido = '$apellido',
                                email = '$email',
                                direccion = '$direccion',
                                telefono = '$telefono',
                                btcaddress = '$btcaddress',
                                admin = '$adm'
                              WHERE id = '$id'";

          $response = $db -> query($updateregistro);

          if (!$response) { echo "<p class="."error".">Error actualizando el registro.</p>"; }
            else { echo "<p class="."ok".">Registro actualizado.</p>"; }

          include ('../closedb.php');
        }

        //Search function
        if (isset($_REQUEST['Search'])) {
          include ('../opendb.php');
          $seleccion = $_REQUEST['opt_busqparticular'];
          $busqueda = $_REQUEST['inp_busqparticular'];

          $searchregistro = "SELECT * from usuarios	WHERE $seleccion = '$busqueda'";
          $response = $db -> query($searchregistro);
          $resp = $response -> fetch_array();

          if (!$resp) { echo "<p class="."error".">Registro no encontrado.</p>"; }
            else { echo "<p class="."ok".">Registro encontrado.</p>"; }

          include ('../closedb.php');
        }

        //DDBB
        include ('../opendb.php');
        $consulta = "SELECT * FROM usuarios ORDER BY id ASC";
        $result = $db -> query($consulta);

        echo "
          <table class=" . "datatable" . ">
          <thead>
            <tr class=" . "thead-row" . ">
              <th>Id</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Crypto wallet</th>
              <th>Admin</th>
            </tr>
          </thead>
          <tbody>
          ";
        while ($registro = $result -> fetch_array()) {
          echo "
            <tr class="."user-row".">
              <td>" . $registro['id'] . "</td>
              <td>" . $registro['nombre'] . "</td>
              <td>" . $registro['apellido'] . "</td>
              <td>" . $registro['email'] . "</td>
              <td>" . $registro['direccion'] . "</td>
              <td>" . $registro['telefono'] . "</td>
              <td>" . $registro['btcaddress'] . "</td>
              <td>" . $registro['admin'] . "</td>
            </tr>
          ";
        }
        echo "</tbody></table>";
        include ('../closedb.php');
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
