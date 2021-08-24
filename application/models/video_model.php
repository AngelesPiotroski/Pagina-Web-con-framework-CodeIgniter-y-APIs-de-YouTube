<?php

class video_model extends CI_Model
{
    public $idvideo_youtube;
    public $idcategoria;

    public function agregarVideoListaBD($videolista)
    {
        //buscar categoria por id usuario
        //insertar video con idvideo_youtube y idcategoria

        $this->idvideo_youtube = $videolista['idvideo_youtube'];
        $this->idcategoria = $videolista['idcategoria'];
        $resul=$this->db->insert('videos', $this); 
        return $resul;
    }
    
    public function eliminarVideoListaBD($idLista, $idVideo)
    {
        $this->db->delete('lista_detalles', [
            'id_cabecera' => $idLista,
            'id_video' => $idVideo
        ]);
        return true;
    }

    public function obtenerIdVideos($idcategoria)
    {
        $this->db->select('idvideo_youtube');
        $this->db->where('id', $idcategoria);
        $query = $this->db->get('videos');
        return $query->result();
    }
}
