<?php

    class segmentacionModel{
        public function __construct(){
            $this->db=Conectar::conexion();
                        
        }
        public function get_segmentoscmu(){
            $query=$this->db->query("SELECT
            COUNT(*) AS cant,
            Segmento,
            DescSegmento
        FROM
            etl_segmentos
        WHERE
            Emp = 2
        AND Segmento <> 10
        GROUP BY
            Segmento
        ORDER BY
            Segmento");
        while($filas=$query->fetch_assoc()){
            $this->segmentoscmu[]=$filas;
        }
        return $this->segmentoscmu;    
        }
        public function get_segmentoscma(){
            $query=$this->db->query("SELECT
            COUNT(*) AS cant,
            Segmento,
            DescSegmento
        FROM
            etl_segmentos
        WHERE
            Emp = 3
        AND Segmento <> 10
        GROUP BY
            Segmento
        ORDER BY
            Segmento");
            while($filas=$query->fetch_assoc()){
                $this->segmentoscma[]=$filas;
            }
            return $this->segmentoscma;    
        }

        public function get_segmentosejecutivos(){
            $query=$this->db->query("SELECT
                    IDEjecutivo,
                Ejecutivo
                FROM
                    etl_segmentos
                GROUP BY
                    IDEjecutivo
                ORDER BY
                    IDEjecutivo");
            while($filas=$query->fetch_assoc()){
                $this->segmentosejecutivos[]=$filas;
            }
            return $this->segmentosejecutivos;    
        }

        public function setIdEjecutivo($idejecutivo){
            $this->idejecutivo=$idejecutivo;
        }
        
        public function get_segmentos(){
            $query=$this->db->query("SELECT
                    Segmento,
                    DescSegmento
                FROM
                    etl_segmentos
                WHERE
                    Segmento <> 10
                GROUP BY
                    Segmento
                ORDER BY
                    Segmento");
            while($filas=$query->fetch_assoc()){
                $this->segmentos[]=$filas;
            }
            return $this->segmentos; 

        }
        public function get_segmentoejecutivo(){
            
            $query=$this->db->query("SELECT
                COUNT(*) AS cant,
                Segmento,
                DescSegmento,
                IDEjecutivo,
                Ejecutivo
            FROM
                etl_segmentos
            WHERE
                Segmento <> 10
            GROUP BY
                Segmento,
                IDEjecutivo
            ORDER BY
                Segmento,
                IDEjecutivo");
            while($filas=$query->fetch_assoc()){
                $this->segmentosejecutivo[]=$filas;
            }
            return $this->segmentosejecutivo;  
        }
        
    }