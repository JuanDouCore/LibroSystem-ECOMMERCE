<?php 

    require_once '../controllers/adminController.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION['loggedin'])||  $_SESSION['loggedin'] != true || !isset($_SESSION['isAdmin'])) {
        $_SESSION['errorLogin'] = "No tienes autorizado acceder al panel de administracion";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="../style.css">
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
            session_start();

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


    <section id="sectionModificarLibroPhp">
        <div class="flexPrincipalModificarLibrosPhp" >
            
        
            <div class="cajaTituloId">
                <form method="post" action="../controllers/adminController.php">
                    <label for="titulo" style="font-size: 20px;">Título:</label>
                    
                    <input type="text" id="titulo" name="titulo" placeholder="Escribe un título">
                    
                    <button name="cargarLibroAmodificar" style="font-size: 20px;"  type="submit" >dsaasd</button>
                </form>

                <form method="post" action="../controllers/adminController.php">
                    <label for="titulo" style="font-size: 20px;">Id:</label>
                    
                    <input type="text" id="id" name="id" placeholder="Escribe el id del libro">
                    
                    <button name="cargarLibroAmodificar" style="font-size: 20px;"  type="submit" >dsaasd</button>
                </form>
            </div>
            
            
            <div class="cajaInfoLibrosIDtit">
                

    
                    <?php 
                        if(isset ($_SESSION ['libroAmodificar'])){
                            $libro = $_SESSION ['libroAmodificar']; 
                            unset($_SESSION ['libroAmodificar']);
                            echo '
                            <div class="formularioCarga">
                            <form action="../controllers/adminController.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="label-box">Titulo:</div>
                                <div class="input-box">
                                    <input  type="text" value="'.$libro->getTitulo().'" name="titulo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Autor:</div>
                                <div class="input-box">
                                    <input type="text" value="'.$libro->getAutor().'" name="autor" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Categoria:</div>
                                <div class="input-box">
                                    <select name="categoria" id="categoria">
                                        <option value="TERROR" '.($libro->getCategoria()=="TERROR"?"selected":"").' >Terror</option>
                                        <option value="COMEDIA" '.($libro->getCategoria()=="COMEDIA"?"selected":"").'>Comedia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Descripcion:</div>
                                <div class="input-box">
                                <textarea name="descripcion" rows="5" required> '.$libro->getDescripcion().' </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Fecha Publicacion:</div>
                                <div class="input-box">
                                    <input type="date" value="'.$libro->getFechaPublicacion().'"  name="fecha_publicacion" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Portada:</div>
                                <div class="input-box">
                                    <input type="file" name="portada" accept="image/*" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label-box">Precio:</div>
                                <div class="input-box">
                                    <input type="number" min="1" value="'.$libro->getPrecio().'" name="precio" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <button class ="botonform" type="submit" name="modificarLibro">Enviar</button>
                            </div>
                        </form>
                            </div>';
                        }
                        else{
                            echo 'No se leyo';
                        }
                        ?>
                    
                



                
            </div>
        </div>

    </section>




    <footer class="footer">Derechos reservados BookStytem ®</footer>

    <script src="../script.js"></script>
</body>

</html>