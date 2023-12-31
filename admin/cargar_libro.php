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
    <link rel="stylesheet" href="../style.css">
    <title>Administrador | Cargar Libro</title>
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


    <section id="seccionCargarLibroPhp">

                <div class="formularioCarga">
                <?php 
                
                if(isset($_SESSION['errorCargaLibro'])){
                    echo '
                    <div class="test-a">
                        <div class="test-a-content">
                            <p>Aviso<p>
                            <p style="color: red;">'.$_SESSION['errorCargaLibro'].'</p>
                            <button class="cerrarModalButton" onclick="location.reload()">Cerrar</button>
                        </div>
                    </div>
                    ';
                    unset($_SESSION['errorCargaLibro']);
                }
                
                ?>
                    <form action="../controllers/adminController.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="label-box">Titulo</div>
                            <div class="input-box">
                                <input type="text" name="titulo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Autor</div>
                            <div class="input-box">
                                <input type="text" name="autor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Categoria</div>
                            <div class="input-box">
                                <select class="select-box" name="categoria" id="categoria">
                                    <option value="CIENCIA FICCION">Ciencia Ficcion</option>
                                    <option value="TERROR">Terror</option>
                                    <option value="COMEDIA">Comedia</option>
                                    <option value="NOVELA">Novela</option>
                                    <option value="MISTERIO Y SUSPENSO">Misterio y Supenso</option>
                                    <option value="FANTASIA">Fantasia</option>
                                    <option value="ROMANCE">Romance</option>
                                    <option value="NO FICCION NARRATIVA">No Ficcion Narrativa</option>
                                    <option value="BIOGRAFIAS Y MEMORIAS">Biografias y Memorias</option>
                                    <option value="AUTOAYUDA Y DESARROLLO PERSONAL">Autoayuda y Desarrollo Personal</option>
                                    <option value="NEGOCIOS Y FINANZAS">Negocios y Finanzas</option>
                                    <option value="LITERATURA CLASICA">Literatura Clásica</option>
                                    <option value="CIENCIA Y DIVULGACION CIENTIFICA">Ciencia y Divulgación Cientifica</option>
                                    <option value="HISTORIA">Historia</option>
                                    <option value="POESIA">Poesia</option>
                                    <option value="VIAJES Y AVENTURAS">Viajes y Aventuras</option>
                                    <option value="OTROS">Otros</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Descripcion</div>
                            <div class="input-box">
                            <textarea name="descripcion" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Fecha Publicacion</div>
                            <div class="input-box">
                                <input type="date" name="fecha_publicacion" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Portada</div>
                            <div class="input-box">
                                <input type="file" name="portada" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Stock</div>
                            <div class="input-box">
                                <input type="number" min="0" value = "0" name="stock" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label-box">Precio</div>
                            <div class="input-box">
                                <input type="number" min="1" value = "1" name="precio" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class ="botonform" type="submit" name="cargarlibro">Cargar Libro</button>
                        </div>
                    </form>
                </div>
    </section>


    <footer class="footerUsuariosPhp">Derechos reservados BookSystem®</footer>

    <script src="../script.js"></script>

    </body>

</html>