<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.theme.css">
    <link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="http://<?php echo base_url() ?>css/estilos.css">
    <script src="http://<?php echo base_url() ?>jquery/jquery-3.6.0.js"></script>
    <script src="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="http://<?php echo base_url() ?>js/scripts.js"></script>
    <title>Registro</title>
</head>

<body>
    <header class="cabecera">
        <h1>Registro de Usuarios</h1>
    </header>
    <nav class="navregis">
        <ul>
            <li><a href="#">Crear una cuenta | </a></li>
            <li><a href="#"> Olvide mi contraseña | </a></li>
            <li><a href="#"> Acerca de nosotros</a></li>
        </ul>
    </nav>

    <div class="cont_datos">
        <form method="post" action="registro/nuevo_usuario" class="conten_form_reg">
            <p class="subtitulos">Datos de Inicio de Sesión</p>
            <div class="datos">
                <div class="colum1">
                    <label for="email">Email</label><label class="validar"></label>
                </div>
                <div class="colum2">
                    <input name="email"  type="email" id="email" onblur="validar_usuario();"required>
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="inputPassword1">Contraseña</label>
                </div>
                <div class="colum2">
                    <input type="password" id="password" name="password" title="contraseña" required>
                </div>
            </div>

            <p class="subtitulos">Datos Personales</p>
            <div class="datos">
                <div class="colum1">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="colum2">
                    <input type="text" name="nombre" id="nombre" title="Nombre">
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="apellido">Apellido</label>
                </div>
                <div class="colum2">
                    <input type="text" name="apellido" id="apellido" title="Apellido">
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="telefono">Número de Telefono</label>
                </div>
                <div class="colum2">
                    <input name="telefono" id="telefono" type="text" title="Número Teléfono">
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="genero">Genero: </label>
                </div>
                <div class="colum2">
                    <label for="radio-1">Masculino</label>
                    <input type="radio" name="radio-1" id="radio-1" value="masculino"class="radiou" />
                    <label for="radio-2">Femenino</label>
                    <input type="radio" name="radio-1" id="radio-2" value="femenino"class="radiou">
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                </div>
                <div class="colum2">
                    <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" title="Fecha de Nacimiento">
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="pagina_web">Pagina Web</label>
                </div>
                <div class="colum2">
                    <input type="url" id="pagina_web" name="pagina_web" title="Página web">
                </div>
            </div>
            <h2>Datos de Localizacion</h2>
            
            <div class="datos">
                <div class="colum1">
                    <label for="provincia">Provincia</label>
                </div>
                <div class="colum2">
                    <select class="form-control" name="provincia" id="provincia">
                        <option value="1">Misiones</option>
                        <option value="2">Buenos Aires</option>
                        <option value="3">Corrientes</option>
                        <option value="4">Formosa</option>
                    </select>
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="ciudad">Ciudad</label>
                </div>
                <div class="colum2">
                    <select class="form-control" id="ciudad" name="ciudad">
                        <option value="1">Posadas</option>
                        <option value="2">Obera</option>
                        <option value="3">Apostoles</option>
                    </select>
                </div>
            </div>
            <div class="datos">
                <div class="colum1">
                    <label for="calle">Calle </label>
                </div>
                <div class="colum2">
                    <input type="text" id="calle" name="calle" title="Calle">
                </div>
            </div>
            <div class="card-footer">
                <button id="btnregistrar" disabled="true" type="submit" name="iniciar_sesion" class="ui-button ui-widget ui-corner-all">Crear Cuenta</button>
            </div>
        </form>

        <aside class="banner_der">
            <img src="http://<?php echo base_url() ?>img/banner.png" alt="mariposa" width="330" height="390" title="mariposa" />
            <p>Al hacer clic en "Crear mi cuenta",
                aceptas las Condiciones y confirmas
                que leíste nuestra Politíca de datos,
                incluido el uso de cookies.</p>
        </aside>
    </div>
    <footer class="footer">
        <div><a class="afooter" href="https://www.youtube.com/" target="_blank"> YouTube - </a></div>
        <div><a class="afooter" href="https://www.ugd.edu.ar/" target="_blank"> U.G.D. - </a></div>
        <div><a class="afooter" href="  https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank">Campus Virtual </a> </div>
    </footer>
</body>

</html>