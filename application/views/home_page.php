<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://apis.google.com/js/api.js"></script>
  <link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.theme.css">
  <link rel="stylesheet" href="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.css">
  <link rel="stylesheet" href="http://<?php echo base_url() ?>css/estilosVideo.css">
  <script src="http://<?php echo base_url() ?>jquery/jquery-3.6.0.js"></script>
  <script src="http://<?php echo base_url() ?>ui/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
  <script src="http://<?php echo base_url() ?>js/scripts.js"></script>
  <title>Home Page</title>


</head>

<body>

  <h1>Video Trend</h1>

  <section id="header">
    <form action="#">
      <fieldset>
        <select name="count" class="count" id="count">
          <option value="user" selected>⚙️ <?= $nombre ?></option>
          <option value="modificar">Modificar datos</option>
          <option value="cerrar">Salir</option>
        </select>
      </fieldset>
    </form>
  </section>

  <section class="encabezado">
    <div>
      <label for="titulo">Titulos</label>
      <input type="text" id="titulo" spellcheck="false" />
    </div>
    <div id="buttons">
      <label>Términos de mi busqueda</label>
      <input id="query" value='cats' type="text" class="inputs" />
      <button id="search-button" onclick="search('')" class="ui-button ui-widget ui-corner-all">buscar</button>
    </div>

    <div>
      <label for="filtro">filtros</label>
      <select class="form-control" name="filtro" id="filtro">
        <option value="viewCount">mas vistos</option>
        <option value="rating">rating</option>
        <option value="date">fecha</option>
        <option value="relevance" selected>mayor relevancia</option>
      </select>
    </div>
  </section>
  <p> </p>

  <div id="search-result">

  </div>
  <input type="hidden" id="pageToken">
  <button id="cargar_mas" onclick="search('pageToken')" class="ui-button ui-widget ui-corner-all">Cargar +</button>

  <section id="accordion">
    <h3 id="videotitulo">Cargar a Nueva Lista</h3>
    <section id="droppable">
      <div id="idvideotitulo">
        <br>
        <br>
        <br>
        <br>
      </div>
    </section>
  </section>

  <div id="modificar_ventana" style="display:none;" title="Cambiar Datos de Usuario">
    <form method="post" action="http://<?php echo base_url() ?>registro/modificar_usuario" class="conten_form_reg">
      <p class="subtitulos">Datos de Inicio de Sesión</p>
      <div class="datos">
        <div class="colum1">
          <label for="email">Email</label><label class="validar"></label>
        </div>
        <div class="colum2">
          <input name="email" type="email" onblur="validar_usuario_a_modificar()" id="email" value="<?= $email ?>" required>
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
          <input type="text" name="nombre" id="nombre" value="<?= $nombre ?>" title="Nombre">
        </div>
      </div>
      <div class="datos">
        <div class="colum1">
          <label for="apellido">Apellido</label>
        </div>
        <div class="colum2">
          <input type="text" name="apellido" id="apellido" value="<?= $apellido ?>" title="Apellido">
        </div>
      </div>
      <div class="datos">
        <div class="colum1">
          <label for="telefono">Número de Telefono</label>
        </div>
        <div class="colum2">
          <input name="telefono" id="telefono" type="text" value="<?= $telefono ?>" title="Número Teléfono">
        </div>
      </div>
      <div class="datos">
        <div class="colum1">
          <label for="genero">Genero: </label>
        </div>
        <div class="colum2">
          <label for="radio-1">Masculino</label>
          <input type="radio" name="radio-1" id="radio-1" class="radiou" />
          <label for="radio-2">Femenino</label>
          <input type="radio" name="radio-1" id="radio-2" class="radiou">
        </div>
      </div>
      <div class="datos">
        <div class="colum1">
          <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        </div>
        <div class="colum2">
          <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $fecha_nacimiento ?>" title="Fecha de Nacimiento">
        </div>
      </div>
      <div class="datos">
        <div class="colum1">
          <label for="pagina_web">Pagina Web</label>
        </div>
        <div class="colum2">
          <input type="url" id="pagina_web" name="pagina_web" value="<?= $pagina_web ?>" title="Página web">
        </div>
      </div>
      <h2>Datos de Localizacion</h2>
      <div class="datos">
        <div class="colum1">
          <label for="calle">Calle </label>
        </div>
        <div class="colum2">
          <input type="text" id="calle" name="calle" value="<?= $calle ?>" title="Calle">
        </div>
      </div>
      <div class="card-footer">
        <button id="btnmodificar" type="submit" name="iniciar_sesion" class="ui-button ui-widget ui-corner-all">Modificar Cuenta</button>
      </div>
    </form>
  </div>

  <div id="cerrar_sesion" style="display:none;" title="Cambiar Datos de Usuario">
    <div class="card-body">
      <form method="post" action="http://<?php echo base_url() ?>login/cerrar_sesion">
        <div class="form-group row">
          <p>¿Seguro que quieres salir?</p>
          <button id="cerrar_sesion" type="submit" name="cerrar_sesion" class="ui-button ui-widget ui-corner-all">Salir</button>
        </div>
      </form>
    </div>
  </div>

  <footer class="footer">
    <div><a class="afooter" target="_blank"> Piotroski Angeles - </a></div>
    <div><a class="afooter" href="https://www.ugd.edu.ar/" target="_blank"> U.G.D. - </a></div>
    <div><a class="afooter" href="  https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank">Campus Virtual </a> </div>
  </footer>
</body>

</html>