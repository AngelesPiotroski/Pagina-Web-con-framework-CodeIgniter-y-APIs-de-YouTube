<?php defined('BASEPATH') or exit('No direct script access allowed');
class login extends CI_Controller
{

    public function index()
    {
        //echo 'seccion index del controlador home_page';
        $this->load->view('formulario_login');
    }

    public function iniciar()
    {
        /*cargar el modelo de usuario y consultar si el email y la constraña coinciden con un usuario en la base datos*/
        $this->load->model('usuarios_model', 'usuario');
        $this->load->model('listas_model', 'listas');
        /*recibir por post el email y la constrasenia*/
        $email = $this->input->post('email');
        $pass =  $this->input->post('password'); 
       
        $password=hash('sha256',$pass);
        
        $resul_valid = $this->usuario->get_usuario_by_email($email);

        
            
        if (count($resul_valid) > 0 and $password == $resul_valid[0]->password) {
            //existe el usuario porque devuelve un array con datos
            //como se guarda un dato en sesion
            $categoria = $this->listas->obtenerListasCargadas($resul_valid[0]->id);
            $newdata = array(
                'email'     => $resul_valid[0]->email,
                'id' => $resul_valid[0]->id,
                'nombre'     => $resul_valid[0]->nombre,
                'apellido'     => $resul_valid[0]->apellido,
                'password'     => $resul_valid[0]->password,
                'idciudad'     => $resul_valid[0]->idciudad,
                'id_provincia'     => $resul_valid[0]->id_provincia,
                'pagina_web'     => $resul_valid[0]->pagina_web,
                'telefono'     => $resul_valid[0]->telefono,
                'fecha_nacimiento'     => $resul_valid[0]->fecha_nacimiento,
                "calle" => $resul_valid[0]->calle,
                'infocategoria'=> json_encode($categoria),
                'logged_in' => TRUE
            );
            $this->session->set_userdata($newdata);
            $this->load->view('home_page', $newdata);
        } else {
            echo'<script type="text/javascript">alert("Email y usuario incorrecto");</script>';
            //echo "Email y usuario incorrecto";
            //llamar a js
            $this->load->view('formulario_login');
        }
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        $this->load->view('formulario_login');
    }

    public function ver_datos_en_sesion()
    {
        print_r($_SESSION);
        echo $this->session->userdata('id');
    }

    
}
