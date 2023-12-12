<?php 
    require_once './controllers/booksController.php';
    
    if (!isset($_SESSION)) {
        session_start();
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
    <title>Books System</title>
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
            <?php 
                if(isset($_SESSION['infoMainMessage'])) {
                    echo '
                    <div class="test-a">
                        <div class="test-a-content">
                            <p>Aviso<p>
                            <p style="color: red;">'.$_SESSION['infoMainMessage'].'</p>
                            <button class="cerrarModalButton" onclick="location.reload()">Cerrar</button>
                        </div>
                    </div>
                    ';
                    unset($_SESSION['infoMainMessage']);
                }
            ?>


    <!--SECCION DE CATEGORIAS-LIBROS-->
    <section id="seccionLibros">
        <p class="tituloLibros">Ciencia Ficcion</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("CIENCIA FICCION");
            ?>
        </div>
    </section>

    <section id="seccionLibros">
        <p class="tituloLibros">Terror</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("TERROR");
            ?>
        </div>
    </section>

    <section id="seccionLibros">
        <p class="tituloLibros">Comedia</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("COMEDIA");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Novela</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("NOVELA");
            ?>
        </div>
    </section>

    <section id="seccionLibros">
        <p class="tituloLibros">Misterio y Suspenso</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("MISTERIO Y SUSPENSO");
            ?>
        </div>
    </section>

    <section id="seccionLibros">
        <p class="tituloLibros">Fantasía</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("FANTASIA");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Romance</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("ROMANCE");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">No Ficción Narrativa</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("NO FICCION NARRATIVA");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Biografías y Memorias</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("BIOGRAFIAS Y MEMORIAS");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Autoayuda y Desarrollo Personal</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("AUTOAYUDA Y DESARROLLO PERSONAL");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Negocios y Finanzas</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("NEGOCIOS Y FINANZAS");
            ?>
        </div>
    </section>


    <section id="seccionLibros">
        <p class="tituloLibros">Literatura Clásica</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("LITERATURA CLASICA");
            ?>
        </div>
    </section>
                

    <section id="seccionLibros">
        <p class="tituloLibros">Ciencia y Divulgación Cientifica</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("CIENCIA Y DIVULGACION CIENTIFICA");
            ?>
        </div>
    </section>

    <section id="seccionLibros">
        <p class="tituloLibros">Historia</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("HISTORIA");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Poesía</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("POESIA");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Viajes y Aventuras</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("VIAJES Y AVENTURAS");
            ?>
        </div>
    </section>
    <section id="seccionLibros">
        <p class="tituloLibros">Otros</p>
        <div class="divFlexLibros">
            <?php 
            leerLibros("OTROS");
            ?>
        </div>
    </section>
  
    
    <footer class="footer">Derechos reservados BookSystem ®<br>Made By: Nania, Ferrara, Carrizo, Retamar</footer>

    <script src="script.js"></script>
</body>

</html>