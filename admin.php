<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || !isset($_SESSION['isAdmin'])) {
        $_SESSION['infoMainMessage'] = "No tienes autorizado acceder al panel de administracion";
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
    <title>Panel de Administrador</title>
</head>
<body>

<!--INICIO HEADER OBLIGATORIO EN TODAS LAS PAGINAS-->
<header>
        <div class="divTit">
            <a href="/librosystem/index.php" class="tituloBoton">Books system</a>
        </div>
        <nav class="navBar">
            <ul>

            <?php 
            

            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {


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

    <section id="sectionAdminUno">
        
        <div class="divPhpAdminPrincipal">
            <h1 class="tituloAdminPhp">Panel de Administrador</h1>
            <p>haga click en una opción</p>
            <?php 
            if(isset($_SESSION['confirmacionPaginaAdmin'])) {
                echo '
                <div class="test-a">
                    <div class="test-a-content">
                        <p>Aviso<p>
                        <p style="color: red;">'.$_SESSION['confirmacionPaginaAdmin'].'</p>
                        <button class="cerrarModalButton" onclick="location.reload()">Cerrar</button>
                    </div>
                </div>
                ';
                unset($_SESSION['confirmacionPaginaAdmin']);
            }
            ?>
        </div>

        <div class="divAdminFlexMain">
        <div class="divLinksPhpAdmin">
            <br>
            <button class="buttonLinksAdminPhp" onclick="redirigir('/librosystem/admin/usuarios.php')"><p>LISTAR USUARIOS</p></button>
            <br>
            <br>
            <br>
            <button class="buttonLinksAdminPhp" onclick="redirigir('/librosystem/admin/cargar_libro.php')"><p>DAR DE ALTA LIBRO</p></button>
            <button class="buttonLinksAdminPhp" onclick="redirigir('/librosystem/admin/modificar_libro.php')"><p>MODIFICAR LIBRO</p></button>
            <button class="buttonLinksAdminPhp" onclick="redirigir('/librosystem/admin/modificar_stock_libro.php')"><p>REPONER STOCK LIBRO</p></button>
            <br><br>
            <button class="buttonLinksAdminPhp" onclick="redirigir('/librosystem/admin/estadisticas.php')"><p>ESTADISTICAS DE LA TIENDA</p></button>
            <br>
        </div>
        </div>
                
    </section>

    
    <footer class="footer">Derechos reservados BookSystem ®<br>Made By: Nania, Ferrara, Carrizo, Retamar</footer>


    <script src="script.js"></script>
</body>
</html>