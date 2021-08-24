<?php

class usuarios_model extends CI_Model {
        

        public function get_usuario_by_email($email){
                $this->db->select('email');
                $this->db->select('password');
                $this->db->select('id');
                $this->db->select('nombre');
                $this->db->select('apellido');
                $this->db->select('genero');
                $this->db->select('fecha_nacimiento');
                $this->db->select('pagina_web');
                $this->db->select('idciudad');
                $this->db->select('telefono');
                $this->db->select('calle');
                $this->db->select('id_provincia');
                $this->db->where('email', $email);
                $query = $this->db->get('usuarios');
                return $query->result();
        }

        public function nuevo_usuario($user)
        {
                $this->email=$user['email']; 
                $this->password=hash('sha256', $user['password']);
                $this->nombre=$user['nombre'];
                $this->genero=$user['genero'];
                $this->apellido=$user['apellido'];
                $this->telefono=$user['telefono']; 
                $this->fecha_nacimiento=$user['fecha_nacimiento'];  
                $this->pagina_web=$user['pagina_web'];
                $this->id_provincia=$user['id_provincia']; 
                $this->idciudad=$user['idciudad'];
                $this->calle=$user['calle'];
                $resul=$this->db->insert('usuarios', $this);
                return $resul;   
        }

        public function modificar_usuario($user){         
                if(count($user)>0){
                        if($user['password']){
                                $this->password=hash('sha256', $user['password']);
                        }
                        if($user['email']){
                                $this->email= $user['email'];
                        }
                        if($user['nombre']){
                                $this->nombre= $user['nombre'];
                        }
                        if($user['apellido']){
                                $this->apellido= $user['apellido'];
                        }
                        if($user['telefono']){
                                $this->telefono= $user['telefono'];
                        }
                        if($user['fecha_nacimiento']){
                                $this->fecha_nacimiento= $user['fecha_nacimiento'];
                        }
                        if($user['genero']){
                                $this->genero= $user['genero'];
                        }
                        if($user['pagina_web']){
                                $this->pagina_web=hash('sha256', $user['pagina_web']);
                        }
                        if($user['id_provincia']){
                                $this->id_provincia= $user['id_provincia'];
                        }
                        if($user['idciudad']){
                                $this->idciudad= $user['idciudad'];
                        }
                        if($user['calle']){
                                $this->calle= $user['calle'];
                        }
                        $this->id=$user['id'];
                        $this->db->where('id', $user['id']);
                        $this->db->update('usuarios', $this); 
                        
                }
        }
}