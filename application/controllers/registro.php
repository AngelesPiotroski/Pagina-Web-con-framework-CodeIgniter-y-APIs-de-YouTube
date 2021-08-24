<?php defined('BASEPATH') or exit('No direct script access allowed');

class registro extends CI_Controller
{
    public function index()
    {
        //echo 'seccion index del controlador login';
        $this->load->view('formulario_registro');
    }

    public function validar_email()
    {
        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');
        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB
        $this->load->model('usuarios_model', 'usuario');
        $arr_usuario = $this->usuario->get_usuario_by_email($email);
        if (count($arr_usuario) > 0 || $email == '') {
            $data = array(
                'warning' => true,
                'message' => 'Correo invalido'
            );
        } else {
            $data = array(
                'success' => true,
                'message' => 'Correo valido'
            );
        }
        echo json_encode($data);
    }

    public function validar_email_a_modificar(){
            
        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');
        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB
        $this->load->model('usuarios_model','usuario');
        
        $arr_usuario=$this->usuario->get_usuario_by_email($email);
        if(count($arr_usuario)>0){
            $data = array(
            'warning' => true,                
            'message' => 'correo invalido'
            );
        }else{
            $data = array(
                'success' => true,                
                'message' => 'Correo valido'
                );                
        }
        echo json_encode($data);
    }
    public function modificar_usuario()
    {
        $this->load->model('usuarios_model', 'usuario');
        $id = $this->session->userdata('id');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nombre = $this->input->post('nombre');
        $genero = $this->input->post('genero');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $fecha_nacimiento = $this->input->post('fecha_nacimiento');
        $pagina_web = $this->input->post('pagina_web');
        $provincia = $this->input->post('provincia');
        $ciudad = $this->input->post('ciudad');
        $calle = $this->input->post('calle');
        $user = array(
            "id" => $id,
            "email" => $email,
            "password" => $password,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "genero" => $genero,
            "telefono" => $telefono,
            "fecha_nacimiento" => $fecha_nacimiento,
            "pagina_web" => $pagina_web,
            "id_provincia" => $provincia,
            "idciudad" => $ciudad,
            "calle" => $calle,
        );
        if (count($user) > 0) {
            $resul = $this->usuario->modificar_usuario($user);
        }
        if ($resul == true) {
            $data = array(
                'success' => true,
                'message' => 'Usuario modificado correctamente'
            );
            $this->load->view('formulario_login', $data);
            //echo json_encode($data);
        } else {
            $data = array(
                'error' => true,
                'message' => 'Error al intentar modificar el usuario'
            );
            //echo json_encode($data);
            $this->load->view('formulario_login', $data);
        }
    }


    public function nuevo_usuario()
    {
        //carga el modelo de usuarios y ejecuta el metodo para insertar un usuario en la DB
        $this->load->model('usuarios_model', 'usuarios');
        //obtiene las variables que se enviar por el formulario de registro via metodo POST
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $genero = $this->input->post('genero');
        $telefono = $this->input->post('telefono');
        $fecha_nacimiento = $this->input->post('fecha_nacimiento');
        $pagina_web = $this->input->post('pagina_web');
        $pais = $this->input->post('pais');
        $id_provincia = $this->input->post('provincia');
        $idciudad = $this->input->post('ciudad');
        $calle = $this->input->post('calle');
        $user = array(
            "email" => $email,
            "password" => $password,
            "nombre" => $nombre,
            "genero" => $genero,
            "apellido" => $apellido,
            "telefono" => $telefono,
            "fecha_nacimiento" => $fecha_nacimiento,
            "pagina_web" => $pagina_web,
            "pais" => $pais,
            "id_provincia" => $id_provincia,
            "idciudad" => $idciudad,
            "calle" => $calle,
        );
        if (count($user) > 0) {
            $resul = $this->usuarios->nuevo_usuario($user);
        }
        if ($resul == true) {
            $data = array(
                'success' => true,
                'message' => 'Usuario registrado correctamente'
            );
            //echo json_encode($data);
            $this->load->view('formulario_login', $data);
        } else {
            $data = array(
                'error' => true,
                'message' => 'Error al intentar registrar el usuario'
            );
            echo json_encode($data);
            $this->load->view('formulario_registro', $data);
        }
    }
}
