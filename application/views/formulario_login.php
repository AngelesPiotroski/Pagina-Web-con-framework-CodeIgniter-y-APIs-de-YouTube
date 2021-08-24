<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>

	<title>Login</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.theme.css">
  <link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.css">
  <link rel="stylesheet" href="http://<?php echo base_url() ?>css/estilosLoginRegistro.css">
  <script src="http://<?php echo base_url() ?>jquery/jquery-3.6.0.js"></script>
  <script src="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="http://<?php echo base_url() ?>js/scripts.js"></script>
</head>

<body>
	<content id="form_loging">
		<header class="cabecera">
			<div><img src="http://<?php echo base_url() ?>img/logo.jpg" alt="logo" width="20" height="20"> </div>
			<div>
				<h1>VideoTrends</h1>
			</div>
			<div>
				<p> Mira tus videos de YouTube como quieras</p>
			</div>
		</header>
		<nav class="menu">
			<ul>
				<li><a href="#">Crear una cuenta | </a></li>
				<li><a href="#"> Olvide mi contraseña | </a></li>
				<li><a href="#"> Acerca de nosotros</a></li>
			</ul>
		</nav>
		<section class="cont_login">
			<aside>
				<img src="http://<?php echo base_url() ?>img/banner.png" class="imagenMariposa" alt="mariposa" width="330" height="390" title="mariposa" />

			</aside>
			<div class="formAndBotton">
				<form class="cont_form" method="POST" action="http://<?php echo base_url() ?>login/iniciar">
					<div>
						<div id="labelmail"><label for="email">Email</label> <label class="validar"></label></div>
						<div><input type="email" id="email" name="email" title="Email"></div>
						<div id="labelcontra"><label for="password">Contraseña</label></div>
						<div><input type="password" id="password" name="password" title="Contraseña"></div>
						<div>
							<p><button type="submit">Iniciar Sesion</button></p>
						</div>
					</div>
				</form>
				<form method="POST" action="http://<?php echo base_url() ?>registro">
					<div>
						<hr>
						</hr>
					</div>
					<button type="submit"> Crear Cuenta</button>
				</form>
			</div>
		</section>
		<footer>
			<div class="footer">
				<div><a class="afooter" href="https://www.youtube.com/" target="_blank"> YouTube - </a></div>
				<div><a class="afooter" href="https://www.ugd.edu.ar/" target="_blank"> U.G.D. - </a></div>
				<div><a class="afooter" href="  https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank">Campus Virtual </a> </div>
			</div>
		</footer>


	</content>
</body>

</html>