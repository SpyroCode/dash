<?php

    class colocacionModel{
        private $db;
        private $coloacionanual;
        private $yy;
        private $periodo;
        private $producto;
        private $tipocte;
        private $tipocto;
        private $casa;
        private $emp;

        public function __construct(){
            $this->db=Conectar::conexion();
            $this->coloacionanual=array();
            $this->casa=2;
            $this->emp=4;
        }

        public function setYy($yy){
            $this->yy=$yy;
        }
        public function setPeriodo($periodo){
            $this->periodo=$periodo;
        }
        public function setProducto($producto){
            $this->producto=$producto;
        }
        public function setTipoCte($tipocte){
            $this->tipocte=$tipocte;
        }
        public function setTipocto($tipocto){
            $this->tipocto=$tipocto;
        }
        public function getYy(){
            return $this->yy;
        }
        public function getPeriodo(){
            return $this->periodo;
        }
        public function getProducto(){
            return $this->producto;
        }
        public function getTipoCte(){
            if($this->tipocte){
                return "";
            }else{
                return $this->casa;
            }
            
        }
        public function getTipocto(){
            return $this->tipocto;
        }

        public function get_colocacionanual(){
            if($this->tipocte){
            $query=$this->db->query("SELECT
            periodo,
            clave AS Producto,
            TRUNCATE(SUM(Monto) / 1000,0)  AS Monto
        FROM
            etl_colocacion_resume
        WHERE
            yy = {$this->getYy()}
           
        GROUP BY
            periodo,
            clave ");
            }else{
                $query=$this->db->query("SELECT
            periodo,
            clave AS Producto,
            TRUNCATE(SUM(Monto) / 1000,0)  AS Monto
        FROM
            etl_colocacion_resume
        WHERE
            yy = {$this->getYy()}
        AND
            IDTipoCte<>{$this->getTipoCte()}    
        GROUP BY
            periodo,
            clave ");
            }
            while($filas=$query->fetch_assoc()){
                $this->coloacionanual[]=$filas;
            }
            return $this->coloacionanual;
        }
        public function get_metas(){
            $query=$this->db->query("SELECT
            metaAP / 1000 AS metaAP,
            metaVP / 1000 AS metaVP,
            metaCR / 1000 AS metaCR
        FROM
            etl_metas
        WHERE
            yy = {$this->getYy()}
        ");
            while($filas=$query->fetch_assoc()){
                $this->metas[]=$filas;
            }
            return $this->metas;
        }
    }
    