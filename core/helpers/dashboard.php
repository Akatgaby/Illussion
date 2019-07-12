<?php
/*
*	Clase para definir las plantillas de las páginas web del sitio privado.
*/
class Dashboard
{
	public static function headerTemplate($title)
	{
		session_start();
		ini_set('date.timezone', 'America/El_Salvador');
		print('
		<!DOCTYPE html>
		<!-- IDIOMA DE LA PÁGINA -->
		<html lang="es">
			<head>
				<!-- BEGIN: Head -->
				<!-- CARACTERES ESPECIALES -->
				<meta charset="UTF-8">
				<!-- TÍTULO DE LA VENTANA -->
				<title>Eclipse | '.$title.'</title>
				<!-- ÍCONO DE LA VENTANA -->
				<link rel="shortcut icon" type="image/x-icon" href="../../resources/img/ico.png">
				<!-- MATERIAL ICONS -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/material-icons.css">
				<!-- MATERIALIZE.MIN -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/materialize.min.css">
				<!-- FUENTE -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/font.css">
				<!-- ESTILO -->
				<link rel="stylesheet" type="text/css" href="../../resources/css/style.css">
				<!-- END: Head-->
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			</head>
		');
		// Se comprueba si existe una sesión para mostrar el menú de opciones, de lo contrario se muestra un menú vacío
		if (isset($_SESSION['idUsuario'])) {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php' && $filename != 'register.php') {
				self::modals();
				print('
					<header>
						<div class="navbar-fixed">
							<nav class="black">
								<div class="brand-sidebar black">
									<a class="brand-logo">
										<img src="../../resources/img/ico.png" alt="ico-illusion" height="25">
										<span class="white-text">Eclipse</span>
									</a>
								</div>
								<div class="nav-wrapper">
									<a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
									<ul class="right hide-on-med-and-down">
										<li><a href="productos.php"><i class="material-icons left">shopping_cart</i>Compras</a></li>
										<li><a href="productos.php"><i class="material-icons left">filter_vintage</i>Productos</a></li>
										<li><a href="categorias.php"><i class="material-icons left">favorite_border</i>Categorías</a></li>
										<li><a href="usuarios.php"><i class="material-icons left">group_add</i>Usuarios</a></li>
										<li><a href="main.php"><i class="material-icons left">home</i>Inicio</a></li>
										<li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">person</i>Cuenta: <b>'.$_SESSION['aliasUsuario'].'</b></a></li>
									</ul>
									<ul id="dropdown" class="dropdown-content">
										<li><a href="#mo" onclick="modalProfile()"><i class="material-icons">mode_edit</i>Perfil</a></li>
										<li><a href="#modal-password" class="modal-trigger"><i class="material-icons">lock</i>Clave</a></li>
										<li><a href="#" onclick="signOff()"><i class="material-icons">power_settings_new</i>Salir</a></li>
									</ul>
								</div>
							</nav>
						</div>
						<ul class="sidenav" id="mobile">
							<li><a href="main.php"><i class="material-icons left">home</i>Inicio</a></li>
							<li><a href="productos.php"><i class="material-icons left">shopping_cart</i>Compras</a></li>
							<li><a href="productos.php"><i class="material-icons left">filter_vintage</i>Productos</a></li>
							<li><a href="categorias.php"><i class="material-icons left">favorite_border</i>Categorías</a></li>
							<li><a href="usuarios.php"><i class="material-icons left">group_add</i>Usuarios</a></li>
							<li><a href="#" class="dropdown-trigger" data-target="dropdown-mobile"><i class="material-icons left">person</i>Cuenta: <b>'.$_SESSION['aliasUsuario'].'</b></a></li>
						</ul>
						<ul id="dropdown-mobile" class="dropdown-content">
							<li><a href="#" onclick="modalProfile()">Editar perfil</a></li>
							<li><a href="#modal-password" class="modal-trigger">Cambiar clave</a></li>
							<li><a href="#" onclick="signOff()">Salir</a></li>
						</ul>
					</header>
					<main class="container">
				');
				$filename = basename($_SERVER['PHP_SELF']);
				if ($filename != 'main.php') {
					print('<h3 class="center-align">'.$title.'</h3>');
				} else {
					print('<h3 class="center-align">Bienvenid@ de vuelta '.$_SESSION['Nombre'].'.</h3>');
				}		
				
			} else {
				header('location: main.php');
			}
		} else {
			$filename = basename($_SERVER['PHP_SELF']);
			if ($filename != 'index.php' && $filename != 'register.php') {
				header('location: index.php');
			} else {
				print('
				<!-- BEGIN: Navbar -->
				<header>
					<div class="navbar-fixed">
						<nav class="black">
							<div class="brand-sidebar black">
								<a class="brand-logo center">
									<img src="../../resources/img/ico.png" alt="ico-illusion" height="25">
									<span class="white-text">Eclipse</span>
								</a>
							</div>
						</nav>
					</div>
				</header>
			<!-- END: Navbar -->
				');
			}
		}
	}

	public static function footerTemplate($controller)
	{
		print('
					<script type="text/javascript" src="../../libraries/jquery-3.2.1.min.js"></script>
					<script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
					<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
					<script type="text/javascript" src="../../resources/js/dashboard.js"></script>
					<script type="text/javascript" src="../../resources/js/init-slider.js"></script>
					<script type="text/javascript" src="../../core/helpers/functions.js"></script>
					<script type="text/javascript" src="../../core/controllers/dashboard/account.js"></script>
					<script type="text/javascript" src="../../core/controllers/dashboard/'.$controller.'"></script>
				</body>
			</html>
		');
	}

	private function modals()
	{
		print('
			<div id="modal-profile" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Editar perfil</h4>
					<form method="post" id="form-profile">
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person</i>
								<input id="profile_nombres" type="text" name="profile_nombres" class="validate" required/>
								<label for="profile_nombres">Nombres</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person</i>
								<input id="profile_apellidos" type="text" name="profile_apellidos" class="validate" required/>
								<label for="profile_apellidos">Apellidos</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">email</i>
								<input id="profile_correo" type="email" name="profile_correo" class="validate" required/>
								<label for="profile_correo">Correo</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">person_pin</i>
								<input id="profile_alias" type="text" name="profile_alias" class="validate" required/>
								<label for="profile_alias">Alias</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>

			<div id="modal-password" class="modal">
				<div class="modal-content">
					<h4 class="center-align">Cambiar contraseña</h4>
					<form method="post" id="form-password">
						<div class="row center-align">
							<label>CLAVE ACTUAL</label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_actual_1" type="password" name="clave_actual_1" class="validate" required/>
								<label for="clave_actual_1">Clave</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_actual_2" type="password" name="clave_actual_2" class="validate" required/>
								<label for="clave_actual_2">Confirmar clave</label>
							</div>
						</div>
						<div class="row center-align">
							<label>CLAVE NUEVA</label>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
								<label for="clave_nueva_1">Clave</label>
							</div>
							<div class="input-field col s12 m6">
								<i class="material-icons prefix">security</i>
								<input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
								<label for="clave_nueva_2">Confirmar clave</label>
							</div>
						</div>
						<div class="row center-align">
							<a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
							<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Cambiar"><i class="material-icons">save</i></button>
						</div>
					</form>
				</div>
			</div>
		');
	}
}