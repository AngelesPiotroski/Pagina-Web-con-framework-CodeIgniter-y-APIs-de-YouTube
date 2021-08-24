<?php

class listas_model extends CI_Model
{
    public $idusuario;
    public $titulo;
    public $fecha_creacion;
    public $id;

    public function crearListaBD($categoria)
    {
        $this->idusuario = $categoria['idusuario'];
        $this->titulo = $categoria['titulo'];
        $this->fecha_creacion = $categoria['fecha_creacion'];
        $resul = $this->db->insert('categorias', $this);
        
        return $resul;
    }
    
    public function getListasUsuarioBD($idusuario,$titulo)
    {
        $this->db->select('id');
        $this->db->where('idusuario', $idusuario);
        $this->db->where('titulo', $titulo);
        $query = $this->db->get('categorias');
        return $query->result();
    }
    public function obtenerListasCargadas($idusuario){
        $this->db->select('id');
        $this->db->select('titulo');
        $this->db->where('idusuario', $idusuario);
        $query = $this->db->get('categorias');
        return $query->result();
    }

    public function obtenerVideosCategorias($idcategoria){
        $this->db->select('id');
        $this->db->select('idvideo_youtube');
        $this->db->where('idcategoria', $idcategoria);
        $query = $this->db->get('videos');
        return $query->result();
    }
}
