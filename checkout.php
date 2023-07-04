<?php

session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <!--INICIO HEADER OBLIGATORIO EN TODAS LAS PAGINAS-->
    <header>
        <div class="divTit">
            <h1 class="titPrincipal">Books system</h1>
        </div>
        <nav class="navBar">
            <ul>

            <?php 

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '
                <li><button onclick="redirigir(\'/librosystem/mi_account.php\')"><p>Mi cuenta</p>
                    <span class="material-symbols-outlined">
                        account_circle
                        </span>
                </button></li>
                ';

                echo '
                <li><button onclick="redirigir(\'/librosystem/checkout.php\')"><p>Carrito</p>
                    <span class="material-symbols-outlined">
                        shopping_cart
                        </span>

                </button></li>
                ';

                if(isset($_SESSION['isAdmin'])) {
                    echo '
                    <li>
                    <button onclick="redirigir(\'/librosystem/admin.php\')"> <p>Administrador</p>
                        <span class="material-symbols-outlined">
                            admin_panel_settings
                            </span>
                    </button>
                    </li>                  
                    ';
                }

                if(isset($_SESSION['isAdmin']) || isset($_SESSION['isEmpleoye'])) {
                    echo '
                    <li><button onclick="redirigir(\'/librosystem/ventas.php\')"><p>Ventas</p>
                    <span class="material-symbols-outlined">
                    sell
                    </span>
                    </button></li>
                    ';
                }

                echo '
                <li><button onclick="redirigir(\'/librosystem/session.php?logout=\')"><p>Cerrar Sesion</p>
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
                if(isset($_SESSION['errorLogin'])) {
                    echo '<p style="color:red;">'.$_SESSION['errorLogin'].'</p>';
                    unset($_SESSION['errorLogin']);
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
        
        <div class="divLibroCheckOut">
        
        <div class="divFotoCheckOut">
            <img src="https://todoaudiolibros.com/usd/wp-content/uploads/2022/02/MOBY-DICK.jpg" alt="mobyDick foto" >
        </div>
        <div>
            <p>El Señor de los Anillos asd asdasdasd as</p>
        </div>
       
        <div>
            <p>Precio</p>
        </div>
       
        <div>
            <p>Cantidad</p>
        </div>
        
        <div>
            <form action="sellController.php" method="post">
                            <input type="hidden" name="libro" value="1">
                            <label for="btnLibro">
                                <input name="eliminardecarrito" id="eliminardecarrito" type="submit" value="Eliminar">
                            </label>
            </form>
        </div>
        
    </div>




    <div class="divLibroCheckOut">
        
        <div class="divFotoCheckOut">
            <img src="https://todoaudiolibros.com/usd/wp-content/uploads/2022/02/MOBY-DICK.jpg" alt="mobyDick foto" >
        </div>
        <div>
            <p>Titulo</p>
        </div>
       
        <div>
            <p>Precio</p>
        </div>
       
        <div>
            <p>Cantidad</p>
        </div>
        
        <div>
            <form action="sellController.php" method="post">
                            <input type="hidden" name="libro" value="1">
                            <label for="btnLibro">
                                <input name="eliminardecarrito" id="eliminardecarrito" type="submit" value="Eliminar">
                            </label>
            </form>
        </div>
        
    </div>

    <div class="divLibroCheckOut">
        
        <div class="divFotoCheckOut">
            <img src="https://todoaudiolibros.com/usd/wp-content/uploads/2022/02/MOBY-DICK.jpg" alt="mobyDick foto" >
        </div>
        <div>
            <p>Titulo</p>
        </div>
       
        <div>
            <p>Precio</p>
        </div>
       
        <div>
            <p>Cantidad</p>
        </div>
        
        <div>
            <form action="sellController.php" method="post">
                            <input type="hidden" name="libro" value="1">
                            <label for="btnLibro">
                                <input name="eliminardecarrito" id="eliminardecarrito" type="submit" value="Eliminar">
                            </label>
            </form>
        </div>
        
    </div>

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

        <form id="datosDeEnvioForm" class="datosDeEnvioForm" method="post" action="/controllers/sellController.php">
                Calle <br>
                <input type="text">
                <br>Altura <br>
                <input type="number">
                <br>Localidad<br>
                <input type="text">
                <br>Provincia<br>
                <input type="text">
                <br>
                <br>
                Metodo de pago
                <label>
                    <input type="radio" name="metodoPago" value="Efectivo">
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
                <p>TOTAL $101010</p>

                <input type="submit" name="procesarCompra_Envio" value="CONFIRMAR">
        </form>

        <form id="datosDeCompraForm" class="datosDeCompraForm" method="post" action="/controllers/sellController.php">
                <br>
                Metodo de pago
                <label>
                    <input type="radio" name="metodoPago" value="Efectivo">
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
                <p>TOTAL $101010</p>

                <input type="submit" name="procesarCompra_Retiro" value="CONFIRMAR">
        </form>
        <br><br>
    </section>
    

    <br><br>
    <footer>Derechos reservados BookStytem ®</footer>

    <script src="script.js"></script>
</body>
</html>