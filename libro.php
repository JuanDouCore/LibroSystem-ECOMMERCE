<?php 
require_once './controllers/booksController.php';

if (!isset($_SESSION)) {
    session_start();
}

$libroAMostrar = leerLibro($_GET['libro']);

?>
 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="style.css">
    <title><?php echo $libroAMostrar->getTitulo();?></title>
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
    
    
    
    <section id="seccionLibrosDescripcion">
        <article class="flexInfoLibro">
            <?php 
            echo '<div class="divFoto"><img src="/images/'.$libroAMostrar->getImagenRuta().'" alt="img libro" ></div>
            <div class="divInfo">
                <h2>'.$libroAMostrar->getTitulo().'</h2>
                <p>'.$libroAMostrar->getCategoria().'</p>
                <br><br>
                <p>'.$libroAMostrar->getDescripcion().'</p>
                <br>
                <p>Autor: '.$libroAMostrar->getAutor().'</p>
                <p>Publicado el '.$libroAMostrar->getFechaPublicacion().'</p>
                <br><br>';
                
                    
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){
                echo'<form action="./controllers/sellController.php" method="post">
                <input type="number" name="cantidad" min="1" value="1"> 
                <input type="hidden" name="libro" value="'.$libroAMostrar->getId().'">
                <label for="btnLibro">
                    <input id="agregarAlCarrito" name="agregarAlCarrito" type="submit" value="Agregar al carrito">
                </label>
            </form>';
            }
            
            if(isset($_SESSION['errorAgregarCarrito'])){
                echo'<p style="color:red;">'.$_SESSION['errorAgregarCarrito'].'</p>';
                unset($_SESSION['errorAgregarCarrito']);
            }

            echo '</div>';
            ?>
        </article>
    </section>
    <br><br>
        <footer class="footer">Derechos reservados BookSystem ®<br>Made By: Nania, Ferrara, Carrizo, Retamar</footer>

    <script src="script.js"></script>
</body>
</html>