<?php defined('BASEPATH') or exit('No direct script access allowed');

class videos extends CI_Controller
{
    public function index()
    {
        //echo 'seccion index del controlador login';
        $this->load->view('home_page');
        $this->getListasUsuario();
    }

    public $titulo;
    public $idvideo_youtube;
    public $idcategoria;

    //poner private


    public function crearLista()
    {
        $this->titulo = $this->input->post('tituloingresado');
        $tittle = $this->titulo;
        $this->load->model('listas_model', 'lista');
        $fecha =  date("Y-m-d H:i:s");

        //echo'<script language="javascript">alert("entre a crear lsita");</script>';

        $id_usuario = $this->session->userdata('id');
        $datauser = $this->session->userdata();

        $categoria = array(
            "titulo" => $tittle,
            "fecha_creacion" => $fecha,
            "idusuario" => $id_usuario
        );
        if (count($categoria) > 0) {
            $resul = $this->lista->crearListaBD($categoria);
            $datauser = $this->session->userdata();
        }
        if ($resul == true) {
            $data = array(
                'success' => true,
                'message' => 'categoria registrada correctamente'
            );
            //echo $data['message'];
            $this->agregarVideoLista();
            $this->load->view('home_page',$datauser);
        } else {
            $data = array(
                'error' => true,
                'message' => 'Error al intentar registrar la categoria'
            );
            //echo $data['message'];
            $this->load->view('home_page', $datauser);
        }
    }


    public function agregarVideoLista()
    {
        /*
            recibo idvideo, idusuario, titulo 
        */
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('listas_model', 'lista');
        $this->load->model('video_model', 'video');
        //tomo el id usuario
        $idusuario = $this->session->userdata('id');
        //tomo los datos de la sesion del usuario
        $datauser = $this->session->userdata();

        //cargo en la variable global asi no se pierden los datos
        $this->idvideo_youtube = $this->input->post('iddevideo');
        $this->titulo = $this->input->post('tituloingresado');

        //creo dos variables con el mismo nombre de la bd para mandarlos
        $idvideo_youtube = $this->idvideo_youtube;
        $titulo = $this->titulo;
        $fecha = date("Y-m-d H:i:s");
        //busco la categoria
        if ($this->titulo <> "") {
            //guardo en la variable global para que no se pierda
            $this->idcategoria = $this->lista->getListasUsuarioBD($idusuario, $titulo);
            $idcategoria =  $this->idcategoria;
            if (count($idcategoria)>0) {
                $videolista = array(
                    "idvideo_youtube" => $idvideo_youtube,
                    "idcategoria" => $idcategoria[0]->id
                );
                $resul = $this->video->agregarVideoListaBD($videolista);
                    
                $datauser = $this->session->userdata();
                if ($resul == true) {
                    $data = array(
                        'success' => true,
                        'message' => 'video agregado a la categoria '
                    );
                    echo $data['message'];
                    $this->load->view('home_page', $datauser);
                } else {
                    $data = array(
                        'error' => true,
                        'message' => 'Error al intentar registrar el video'
                    );
                    echo $data['message'];
                    $this->load->view('home_page', $datauser);
                }
            }else{
                $this->crearLista();
            }
        } else {
            echo '<script language="javascript">alert("Debe ingresar un titulo");</script>';
            $this->load->view('home_page');
        }

            /*
            if (!$idcategoria) {
                $id_usuario = $this->session->userdata('id');
                $datauser = $this->session->userdata();

                $categoria = array(
                    "titulo" => $titulo,
                    "fecha_creacion" => $fecha,
                    "idusuario" => $id_usuario
                );
                if (count($categoria) > 0) {
                    $idcategoria = $this->lista->crearListaBD($categoria);
                }
            }
            $videolista = array(
                "idvideo_youtube" => $idvideo_youtube,
                "idcategoria" => $idcategoria
            );
            $resul = $this->video->agregarVideoListaBD($videolista);

            $datauser = $this->session->userdata();
            if ($resul == true) {
                $data = array(
                    'success' => true,
                    'message' => 'video agregado a la categoria '
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'error' => true,
                    'message' => 'Error al intentar registrar el video'
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                'error' => true,
                'message' => 'EL TITULO NO DEBE SER VACIO'
            );
            echo json_encode($data);
        }*/
    }


    /*
    public function agregarVideoLista()
    {
        /*
            recibo idvideo, idusuario, titulo 
        *//*
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('listas_model', 'lista');
        $this->load->model('video_model', 'video');
        //tomo el id usuario
        $idusuario = $this->session->userdata('id');
        //tomo los datos de la sesion del usuario
        $datauser = $this->session->userdata();

        //cargo en la variable global asi no se pierden los datos
        $this->idvideo_youtube = $this->input->post('iddevideo');
        $this->titulo = $this->input->post('tituloingresado');

        //creo dos variables con el mismo nombre de la bd para mandarlos
        $idvideo_youtube=$this->idvideo_youtube;
        $titulo=$this->titulo;
        //busco la categoria
        if ($this->titulo <> "") {
            //guardo en la variable global para que no se pierda
            $this->idcategoria =$this->lista->getListasUsuarioBD($idusuario, $titulo);
        
            $idcategoria=  $this->idcategoria;
            
            if (count($idcategoria)>0) {
                $videolista = array(
                    "idvideo_youtube" => $idvideo_youtube,
                    "idcategoria" => $idcategoria[0]->id
                );
                $resul = $this->video->agregarVideoListaBD($videolista);
                    
                $datauser = $this->session->userdata();
                if ($resul == true) {
                    $data = array(
                        'success' => true,
                        'message' => 'video agregado a la categoria '
                    );
                    echo'<script type="text/javascript">alert("video agregado a la lista");</script>';
                    $this->load->view('home_page', $datauser);
                } else {
                    $data = array(
                        'error' => true,
                        'message' => 'Error al intentar registrar el video'
                    );
                    echo'<script type="text/javascript">alert("Error al intentar registrar el video");</script>';
                    $this->load->view('home_page', $datauser);
                }
            }else{
                $this->crearLista();
            }
        } else {
            echo '<script language="javascript">alert("Debe ingresar un titulo");</script>';
            $this->load->view('home_page');
        }
    //}
    /*
        funcion que obtiene del usuario logeado el id
        luego busca las categorias que tiene y agarra el titulo de cada una
        luego busca los videos de cada una de esas categorias y toma el id
        finalmente debe de mandar a la vista para que en la vista se muestre 
    */
    /*
    public function getListasUsuario()
    {
        
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('listas_model', 'lista');
        $this->load->model('video_model', 'video');

        $datauser = $this->session->userdata();
        $idusuario = $this->session->userdata('id');
        
        $listasDelUsuario =$this->lista->obtenerListasCargadas($idusuario);
        //de listas de usuario obtener el idcategoria y ahi mandar a buscar los idvideos con ese idcategoria
        $idcategoria=$listasDelUsuario[0]->id;
        //obtengo los idvideos
        $idVideosDeLista =$this->video->obtenerIdVideos($idcategoria);
       // echo $listasDelUsuario[0]->id;
       // echo $idVideosDeLista[0]->id; 

        $datauser = $this->session->userdata();

        if ($idVideosDeLista == true) {
            $data = array(
                'success' => true,
                'message' => 'videos recibidos de bd'
            );
            //echo $data['message'];
            $this->load->view('home_page', $datauser);
        } else {
            $data = array(
                'error' => true,
                'message' => 'Error al intentar obtener los videos de la categoria'
            );
           // echo $data['message'];
            $this->load->view('home_page', $datauser);
        }

    }

*/



    public function eliminarVideoLista()
    {
        if ($this->input->get('idVideo') && $this->input->get('idLista')) {
            if ($this->lista->eliminarVideoLista($this->input->get('idLista'), $this->input->get('idVideo'))) {
                // echo json_encode(['ok' => true]);
            } else {
                //  echo json_encode(['ok' => false]);
            }
            return;
        }
    }

    public function getVideos()
    {
        if ($this->input->get('terminos')) {
            $params = [
                'q' => $this->input->get('terminos'),
                'key' => 'AIzaSyC2bghUGlYGAfYYQbQsVpMvRZfPEaBK6Hs',
                'part' => 'id'
            ];
            if ($this->input->get('token')) {
                $params['pageToken'] = $this->input->get('token');
            }
            $ch = curl_init('https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest' . http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);

            if ($result) {
                $json = json_decode($result);
                if ($json) {
                    //echo json_encode($this->parseBusqueda($json));
                    return;
                }
            }
            //echo json_encode(['ok' => false, 'error' => 'Error desconocido']);
            return;
        } else {
            //  echo json_encode(['ok' => false, 'error' => 'Sin parametros']);
            return;
        }
    }

    private function parseBusqueda($json)
    {
        $search = [
            'ok' => true,
            'next' => $json->nextPageToken,
            'results' => []
        ];
        foreach ($json->items as $v) {
            $search['results'][] = $v->id->videoId;
        }
        return $search;
    }


    public function getListasUsuario()
    {
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('listas_model', 'lista');
        $this->load->model('video_model', 'video');

        $datauser = $this->session->userdata();
        $idusuario = $this->session->userdata('id');

        $listasDelUsuario = $this->lista->obtenerListasCargadas($idusuario);

        $idVideosDeLista = $this->video->obtenerIdVideos($idusuario);
    }

    public function getListaVideos()
    {
        $this->load->model('usuarios_model', 'usuarios');
        $this->load->model('listas_model', 'lista');
        $this->load->model('video_model', 'video');
        $categorias = $this->lista->obtenerListasCargadas($this->session->userdata('id'));
        if (count($categorias) > 0) {
            foreach ($categorias as &$categoria) {
                $categoria->videos = $this->lista->obtenerVideosCategorias($categoria->id);
            }
        }
        echo json_encode($categorias);
    }
}
