<?php
 
    class segmentacionController{
        
        public function index(){
            require_once("models/segmentacionModel.php");
            
            $idejecutivo=4;
            $segmentos =  new segmentacionModel();
            $segmentos_cmu=$segmentos->get_segmentoscmu();
            $segmentos_cma=$segmentos->get_segmentoscma();
            $segmentos_ejecutivos=$segmentos->get_segmentosejecutivos();
            $segmentos_ejecs=$segmentos->get_segmentoejecutivo();
            require_once 'views/dashboard/segmentacion.php'; 
        }    

    }