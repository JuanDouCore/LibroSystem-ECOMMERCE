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
    <header>
        <div class="divTit">
            <h1 class="titPrincipal">Books system</h1>
        </div>
        <nav class="navBar">
            <ul>
                <li>
                    <button onclick="openModalRegister()"><p>Registrarse</p> <span class="material-symbols-outlined">
                    how_to_reg
                    </span>
                    </button>
                </li>
                
                <li>
                    <button onclick="openModalLogin()"><p>Iniciar Sesion</p>
                    <span class="material-symbols-outlined">
                        login
                </button>
                </li>
                <li><button onclick="redirigir('/librosystem/session.php?logout=')"><p>Cerrar Sesion</p>
                    <span class="material-symbols-outlined">
                        logout
                        </span>
                </button></li>

  

                <li><button onclick="redirigir('/librosystem/mi_account.php')"><p>Mi cuenta</p>
                    <span class="material-symbols-outlined">
                        account_circle
                        </span>
                </button></li>
                <li><button onclick="redirigir('/librosystem/carrito.php')"><p>Carrito</p>
                    <span class="material-symbols-outlined">
                        shopping_cart
                        </span>

                </button></li>

                <li>
                    <button onclick="redirigir('/librosystem/admin.php')"> <p>Administrador</p>
                        <span class="material-symbols-outlined">
                            admin_panel_settings
                            </span>
                    </button>
                </li>    
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



    <!--SECCION DE CATEGORIAS-LIBROS-->

    <section id="seccionLibros">
        <p class="tituloLibros">Terror</p>
        
        <div class="divFlexLibros">
        
            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <section id="seccionLibros">
        <p class="tituloLibros">Comedia</p>
        
        <div class="divFlexLibros">
        
            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <section id="seccionLibros">
        <p class="tituloLibros">Ciencia Ficcion</p>
        
        <div class="divFlexLibros">
        
            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

            <div class="divLibros">
                <p class="tituloLibro">El Señor de los Anillos</p>
                <div class="divImgLibro"><img src="" alt="imagenLibros"></div>
                <br>
                <p class="precioLibro">$100</p>
                <div class="botonFlex">
                    <form method="get" action="libro.php">
                        <input type="hidden" name="libro" value="1">
                        <label for="btnLibro">
                            <input id="btnLibro" type="submit" value="Ver libro">
                        </label>
                    </form>
                </div>
            </div>

    </div>
    </section>

    
    <footer>Derechos reservados BookStytem ®</footer>

    <script src="script.js"></script>
</body>
</html>