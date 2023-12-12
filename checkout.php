<?php

require_once './controllers/sellController.php';

if (!isset($_SESSION)) {
    session_start();
}

//prevenir que entre sin estar logead
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: index.php");
    exit();
}


//Prevenir que entre si el carrito esta vacio
if(!isset($_SESSION['carrito'])) {
    $_SESSION['infoMainMessage'] = "Tu carrito esta vacio, considera agregar libros";
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="style.css">
    <title>Carrito</title>
</head>
<body>
    <!--INICIO HEADER OBLIGATORIO EN TODAS LAS PAGINAS-->
    <header>
        <div class="divTit">
            <a href="/index.php" class="tituloBoton">Books system</a>
        </div>
        <nav class="navBar">
            <ul>

            <?php 

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {


                echo '
                <li><button onclick="redirigir(\'/checkout.php\')"><p>Carrito</p>
                    <span class="material-symbols-outlined">
                        shopping_cart
                        </span>

                </button></li>
                ';

                if(isset($_SESSION['isAdmin'])) {
                    echo '
                    <li>
                    <button onclick="redirigir(\'/admin.php\')"> <p>Administrador</p>
                        <span class="material-symbols-outlined">
                            admin_panel_settings
                            </span>
                    </button>
                    </li>                  
                    ';
                }

                if(isset($_SESSION['isAdmin']) || isset($_SESSION['isEmpleoye'])) {
                    echo '
                    <li><button onclick="redirigir(\'/ventas.php\')"><p>Ventas</p>
                    <span class="material-symbols-outlined">
                    sell
                    </span>
                    </button></li>
                    ';
                }

                echo '
                <li><button onclick="redirigir(\'/session.php?logout=\')"><p>Cerrar Sesion</p>
                    <span class="material-symbols-outlined">
                        logout
                        </span>
                </button></li>
                ';

            } else {
                echo '<li>';
                echo '<button onclick="openModalRegister()"><p>Registrarse</p> <span class="material-symbols-outlined">';
                echo 'how_to_reg';
                echo '</span>';
                echo '</button>';
                echo '</li>';

                echo '
                <li>
                    <button onclick="openModalLogin()"><p>Iniciar Sesion</p>
                    <span class="material-symbols-outlined">
                        login
                </button>
                </li>
                ';
            }
            ?>


            </ul>
            <?php 
                if(isset($_SESSION['infoMainMessage'])) {
                    echo '<p style="color:red;">'.$_SESSION['infoMainMessage'].'</p>';
                    unset($_SESSION['infoMainMessage']);
                }
            ?>
        </nav>
    </header>

    <div id="login" class="login">
        <div class="login-content">
			<form class="loginForm" method="post" action="session.php">
				<label for="user">Usuario</label>
				<input type="text" name="user" id="user">
					<br>
				<label for="password">Contraseña</label>
				<input type="password" name="password" id="password">
					<br>
					<br>
				<input type="submit" name="login" id="login" value="Ingresar">
					<br>
                    <br>
			</form>
				<br>
                <button onclick="closeModalLogin()">Salir</button>
        </div>
    </div>
	
    
	<div id="register" class="register">
        <div class="register-content">
			<form class="registerForm" method="post" action="session.php">
				<label for="user">Usuario</label>
				<input type="text" name="user" id="user">
					<br>
				<label for="name">Nombre y apellido</label>
				<input type="text" name="name" id="name">
					<br>
				<label for="password">Contraseña</label>
				<input type="password" name="password" id="password">
					<br>
				<label for="DNI">Documento</label>
				<input type="number" name="DNI" id="DNI">
					<br>
				<input type="submit" name="register" id="register" value="Registrarse">
					<br>
                    <br>
			</form>
				<br>
                <button onclick="closeModalRegister()">Salir</button>
        </div>
    </div>
    <!--FIN HEADER OBLIGATORIO EN TODAS LAS PAGINAS-->

    <section>
        <article class="ArticlePrincipalCheckout">
        <p>Libros en el carrito</p>
        <br>

        <?php 
        cargarLibrosCarrito();
        ?>

    </article>
    
</section>


    <section class="seccionInfoEnvio">
    <br><br>
        <div class="opcionMetodoEntrega">
            <label for="metodoEnvio">Metodo entrega</label>
            <select id="optionValue" onchange="changeMetodoEnvio()">
                <option value="retiroLocal">Retiro en el local</option>
                <option value="aDomicilio">Envio a domicilio</option>
            </select>
        </div>

        <?php 
            if(isset($_SESSION['errorCheckout'])){
                echo'<p style="color:red;">'.$_SESSION['errorCheckout'].'</p>';
                unset($_SESSION['errorCheckout']);
            }
        ?> 



        <form id="datosDeEnvioForm" class="datosDeEnvioForm" method="post" action="./controllers/sellController.php">
                Calle <br>
                <input type="text" name="calle" id="calle" required>
                <br>Altura <br>
                <input type="number" name="altura" id="altura" required>
                <br>Localidad<br>
                <input type="text" name="localidad" id="localidad" required>
                <br>Provincia<br>
                <input type="text"  name="provincia" id="provincia" required>
                <br>
                <br>
                Metodo de pago
                <label>
                    <input type="radio" name="metodoPago" value="Efectivo" checked>
                    Efectivo
                </label>
                <label>
                    <input type="radio" name="metodoPago" value="Tarjeta">
                    Tarjeta
                </label><label>
                    <input type="radio" name="metodoPago" value="Transferencia">
                    Mercadopago / Transferencia
                </label>
                <br><br>
                <p>TOTAL $<?php calcularTotalCarrito()?></p>

                <button class="botonform" type="submit" name="procesarCompra_Envio">Comprar</button>

        </form>

        <form id="datosDeCompraForm" class="datosDeCompraForm" method="post" action="./controllers/sellController.php">
                <br>
                Metodo de pago
                <label>
                    <input type="radio" name="metodoPago" value="Efectivo" checked>
                    Efectivo
                </label>
                <label>
                    <input type="radio" name="metodoPago" value="Tarjeta">
                    Tarjeta
                </label><label>
                    <input type="radio" name="metodoPago" value="Transferencia">
                    Mercadopago / Transferencia
                </label>
                <br><br>
                <p>TOTAL $<?php calcularTotalCarrito()?></p>

                <button class="botonform" type="submit" name="procesarCompra_Retiro">Comprar</button>
        </form>
        <br><br>
    </section>
    

    <br><br>
    <footer class="footer">Derechos reservados BookSystem ®<br>Made By: Nania, Ferrara, Carrizo, Retamar</footer>

    <script src="script.js"></script>
</body>
</html>