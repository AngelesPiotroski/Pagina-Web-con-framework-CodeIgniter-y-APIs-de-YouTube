
$(document).ready(function () {
  $(function () {
    //llamado a funcion para obtener los videos del usuario apenas se inica la pagina
    obtenerListaVideos();
    function start() {
      // Initializes the client with the API key and the Translate API.
      gapi.client.init({
        'apiKey': 'AIzaSyDpchwdcAQ0sRLsJxC7raguMNuVIyM3AcY',
        'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest']
      }).then(function () {
        // Executes an API request, and returns a Promise.
        // The method name `language.translations.list` comes from the API discovery.
        return gapi.client.youtube.search.list({
          q: 'valor fijo de consulta',
          part: 'snippet',
          maxResults: 4
        });
      }).then(function (response) {
        //esta seccion se podria utilizar la respuesta para modicar o embeber en un reproductor un video	
        console.log(response);
      }, function (reason) {
        console.log('Error: ' + reason.result.error.message);
      });
    };
    // Loads the JavaScript client library and invokes start afterwards.
    gapi.load('client', start);
  });
});

// Search for a specified string.
function search(str_page) {
  //obtengo el valor de la consulta
  var q = $('#query').val();
  var str_page_token = '';
  if (str_page == '') {
    $('#search-result').html('');
  } else {
    //guardo el token para luego buscar los siguientes videos
    str_page_token = $('#' + str_page).val();
  }
  //armo la consulta a la api
  var request = gapi.client.youtube.search.list({
    q: q,
    part: 'snippet',
    type: 'video',
    maxResults: 4,
    order: $('#filtro').val(),
    pageToken: str_page_token
  });
  //obtengo la respuesta
  request.execute(function (response) {
    //tomo el siguiente token
    $('#pageToken').val(response.nextPageToken);
    //tomo el titulo ingresado por el usuario
    let tittle = $("#titulo").val();
    $.each(response.items, function (index, val) {
      //tomo el id video y armo el iframe
      let idvideo_yt = val.id.videoId;
      $('#search-result').append(' <iframe id="draggable" titulovideo=' + tittle + ' idvideo=' + idvideo_yt + '  width="320" height="215" src="https://www.youtube.com/embed/' + idvideo_yt + '"> </iframe>');
    });
    //llamo a funcion js para cargar los elementos iframe y que sean draggables
    cargarJqueryUI();
  });
}
function validar_usuario(){
  $.ajax({
      method: "POST",
      url: "/app/registro/validar_email",
      data: { email: $('#email').val()}
  }).done(function( msg ) {
      
      var data=JSON.parse(msg);

      if(data.warning){
        $("#btnregistrar").attr("disabled",true)
          alert(data.message);
      }
      
      if(data.success){
          $("#btnregistrar").attr("disabled",false)
          alert(data.message);
      }        
      
  });   
}

function validar_usuario_a_modificar(){
  $.ajax({
      method: "POST",
      url: "/app/registro/validar_email_a_modificar",
      data: { email: $('#email').val()}
  }).done(function( msg ) {
     
      var data=JSON.parse(msg);

      if(data.warning){
        
         alert(data.message);
          
      }
      
      if(data.success){
          alert(data.message);
      }        
      
  });   
}

let iddevideo = ""
let tituloingresado = ""
$(function () {
  $("#droppable").droppable({
    drop: function (event, ui) {
      $(this)
        .addClass("ui-state-highlight")
      //inserto en el html el titulo e id del video en el primer acordeon
      $("#videotitulo").html(tituloingresado);
      $("#idvideotitulo").html(iddevideo);
      //mando una peticion al controlador para que agregue el video a la lista del usuario
      $.ajax({
        method: "POST",
        url: "http://localhost/app/videos/agregarVideoLista",
        data: { "tituloingresado": tituloingresado, "iddevideo": iddevideo },
        dataType: "json"
      })
        .done(function (msg) {
          console.log("se resolvio el ajax");
        })
        .fail(function (textStatus) {
          console.log(textStatus);
          //console.log("ESTOY EN EL FAIL");
        });
    
        obtenerListaVideos();
       // location.reload();
      }
  });
});

//funcion que se ejecuta luego de crear los iframes y los hace que sean draggables y obtiene el titulo e id del iframe que se hace drag
function cargarJqueryUI() {
  document.querySelectorAll("iframe").forEach(e => {
    $(e).draggable({
      connectToSortable: "#sortable",
      helper: "clone",
      revert: "invalid",
      drag: function (event) {
        iddevideo = event.target.getAttribute("idvideo")
        tituloingresado = event.target.getAttribute("titulovideo")
      }
    });
    e.classList.add("ui-state-default");
  });
}

//funcion que realiza una peticion para obtener los videos cargados del usuario
function obtenerListaVideos(){
  $.ajax({
    method: "GET",
    url: "http://localhost/app/videos/getListaVideos",
    dataType: "json"
    
  })
    .done(function (data) {
      data.forEach(function(e){
        //llamado a funcion que genera los acordeones
        generarElementoAcordion(e);
      })
      console.log(data);
      //console.log("se resolvio el ajax");
    })
    .fail(function (textStatus) {
      console.log(textStatus);
      //console.log("ESTOY EN EL FAIL");
    });
} 
//funcion que agrega los iframes de los videos recibidos de la bd y los carga en el acordeon
function generarElementoAcordion(categoria){
  videos='';
  console.log("categoria es sss"+categoria);
  categoria.videos.forEach(function(video){
    videos+=' <iframe idvideo=' + video.id + '  width="320" height="215" src="https://www.youtube.com/embed/' + video.idvideo_youtube + '"> </iframe>';
    console.log("dentro de un foreach");
  })
  html='<h3 >'+categoria.titulo+'</h3>'+
  '<section id="categoria'+categoria.id+'">'+
    videos+
  '</section>';
  //crea cada acordeon 
  $('#accordion').append(html);
  $( "#accordion" ).accordion('refresh');
  $("#categoria"+categoria.id).droppable({
    drop: function (event, ui) {
      $(this)
        .addClass("ui-state-highlight")
      //.find("p")
      $("#videotitulo").html(tituloingresado);
      $("#idvideotitulo").html(iddevideo);

      $.ajax({
        method: "POST",
        url: "http://localhost/app/videos/agregarVideoLista",
        data: { "tituloingresado": categoria.titulo, "iddevideo": iddevideo },
        dataType: "json"
      })
        .done(function (msg) {
          console.log("termine el ajax 1 vez");
          //console.log("se resolvio el ajax");
        })
        .fail(function (textStatus) {
          console.log(textStatus);
          //console.log("ESTOY EN EL FAIL");
        });
    }
  });
  
}

//todas las funciones del jquery ui 
$(function () {
  $(document).tooltip();
  $("#fecha_nacimiento").datepicker();
  $("#pageToken").hide();
  $("#accordion").accordion();
  $(".radiou").checkboxradio({
    icon: false
  });
  $("#count").selectmenu();
  $("#filtro").selectmenu();
  $("#provincia").selectmenu();
  $("#pais").selectmenu();
  $("#ciudad").selectmenu();
  $('#count').selectmenu({
    classes: {
      "count": "count"
    },
    select: function (e, ui) {
      if (ui.item.value == 'modificar') {
        $(function () {
          $("#modificar_ventana").dialog({
            modal: true,
          })
        });
      }
      if (ui.item.value == 'cerrar') {
        $(function () {
          $("#cerrar_sesion").dialog({
            modal: true,
          })
        });
      }
    },
  })
});

