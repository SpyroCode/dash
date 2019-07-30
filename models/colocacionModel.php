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
            if($this->tipocto){
                return "QUIROGRAFARIO";
            }else{
                return "";
            }
            
        }
        
        public function get_colocacionanual(){
            
            if($this->tipocte){
                if($this->tipocto){
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
                            Producto<>'QUIROGRAFARIO'
                        GROUP BY
                            periodo,
                            clave ");
                }
                    
            }else{
                if($this->tipocto){
                    $query=$this->db->query("SELECT
                        periodo,
                        clave AS Producto,
                        TRUNCATE(SUM(Monto) / 1000,0)  AS Monto
                    FROM
                        etl_colocacion_resume
                    WHERE
                        yy = {$this->getYy()}
                    AND
                        IDTipoCte<>2
                    AND
                        IDTipoCte<>4        
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
                        Producto<>'QUIROGRAFARIO'
                    AND
                        IDTipoCte<>2
                    AND
                        IDTipoCte<>4        
                    GROUP BY
                        periodo,
                        clave ");
                }
                
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

        public function get_colocacionTipoCte(){
            $query=$this->db->query("SELECT
            IDTipoCte,
            TipoCliente,
            SUM(Monto) / 1000 AS Monto
        FROM
            etl_colocacion_resume
        WHERE
            yy = {$this->getYy()}
            AND periodo= {$this->getPeriodo()}    
        GROUP BY
            IDTipoCte
        ORDER BY
            IDTipoCte ASC");

            while($filas=$query->fetch_assoc()){
                $this->coltipocte[]=$filas;
            }
            return $this->coltipocte;
        }

        public function get_colocacionSector(){
            $query=$this->db->query("SELECT
            Sector,
            SUM(Monto) / 1000 AS Monto
        FROM
            etl_colocacion_resume
        WHERE
            yy = {$this->getYy()}
        AND periodo= {$this->getPeriodo()}   
        GROUP BY
            IDSector
        ORDER BY
            IDSector ASC
        ");

            while($filas=$query->fetch_assoc()){
                $this->colSector[]=$filas;
            }
            return $this->colSector;

        }

        public function get_colocacionTipop(){
            $query=$this->db->query("SELECT
            Producto,
            SUM(Monto) / 1000 AS Monto
        FROM
            etl_colocacion_resume
        WHERE
            yy = {$this->getYy()}
        and periodo={$this->getPeriodo()}
        GROUP BY
            Producto
        ORDER BY
            Producto ASC");
            while($filas=$query->fetch_assoc()){
                $this->colTipop[]=$filas;
            }
            return $this->colTipop;

        }
        public function get_colocacionTipoCteN(){
            $query=$this->db->query("SELECT
                    clave,
                    TipoCliente,
                    IDTipoCte,
                    TRUNCATE(SUM(Monto) / 1000,0) AS Monto
                FROM
                    etl_colocacion_resume
                WHERE
                    yy = {$this->getYy()}
                AND periodo = {$this->getPeriodo()}
                AND IDTipoCte = 1
                GROUP BY
                    clave
                ORDER BY
                    clave ASC");
            while($filas=$query->fetch_assoc()){
                $this->colTipoN[]=$filas;
            }
            return $this->colTipoN;
        }
        public function get_colocacionTipoCteC(){
            $query=$this->db->query("SELECT
                    clave,
                    TipoCliente,
                    IDTipoCte,
                    TRUNCATE(SUM(Monto) / 1000,0) AS Monto
                FROM
                    etl_colocacion_resume
                WHERE
                    yy = {$this->getYy()}
                AND periodo = {$this->getPeriodo()}
                AND IDTipoCte = 2
                GROUP BY
                    clave
                ORDER BY
                    clave ASC");
            while($filas=$query->fetch_assoc()){
                $this->colTipoC[]=$filas;
            }
            return $this->colTipoC;
        }
        public function get_colocacionTipoCteR(){
            $query=$this->db->query("SELECT
                    clave,
                    TipoCliente,
                    IDTipoCte,
                    TRUNCATE(SUM(Monto) / 1000,0) AS Monto
                FROM
                    etl_colocacion_resume
                WHERE
                    yy = {$this->getYy()}
                AND periodo = {$this->getPeriodo()}
                AND IDTipoCte = 3
                GROUP BY
                    clave
                ORDER BY
                    clave ASC");
            while($filas=$query->fetch_assoc()){
                $this->colTipoR[]=$filas;
            }
            return $this->colTipoR;
        }
        public function get_colocacionTipoCteE(){
            $query=$this->db->query("SELECT
                    clave,
                    TipoCliente,
                    IDTipoCte,
                    TRUNCATE(SUM(Monto) / 1000,0) AS Monto
                FROM
                    etl_colocacion_resume
                WHERE
                    yy = {$this->getYy()}
                AND periodo = {$this->getPeriodo()}
                AND IDTipoCte = 4
                GROUP BY
                    clave
                ORDER BY
                    clave ASC");
            while($filas=$query->fetch_assoc()){
                $this->colTipoE[]=$filas;
            }
            return $this->colTipoE;
        }
        public function get_colocacionEjecutivo(){
            if($this->tipocte){
                if($this->tipocto){
                $query=$this->db->query("SELECT
                                IDEjecutivo,
                                Ejecutivo,
                                clave,
                                TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                            FROM
                                etl_colocacion_resume
                            WHERE
                                yy = {$this->getYy()}
                            AND periodo = {$this->getPeriodo()}
                            GROUP BY
                                IDEjecutivo,
                                clave
                            ORDER BY
                                IDEjecutivo,
                                clave");
                }else{
                    $query=$this->db->query("SELECT
                                IDEjecutivo,
                                Ejecutivo,
                                clave,
                                TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                            FROM
                                etl_colocacion_resume
                            WHERE
                                yy = {$this->getYy()}
                            AND 
                                periodo = {$this->getPeriodo()}
                            AND 
                                Producto<>'QUIROGRAFARIO'
                            GROUP BY
                                IDEjecutivo,
                                clave
                            ORDER BY
                                IDEjecutivo,
                                clave");

                }
            }else{
                if($this->tipocto){
                    $query=$this->db->query("SELECT
                                IDEjecutivo,
                                Ejecutivo,
                                clave,
                                TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                            FROM
                                etl_colocacion_resume
                            WHERE
                                yy = {$this->getYy()}
                            AND 
                                periodo = {$this->getPeriodo()}
                            AND 
                                IDTipoCte<>2
                            AND
                                IDTipoCte<>4      
                            GROUP BY
                                IDEjecutivo,
                                clave
                            ORDER BY
                                IDEjecutivo,
                                clave");
                }else{
                    $query=$this->db->query("SELECT
                                IDEjecutivo,
                                Ejecutivo,
                                clave,
                                TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                            FROM
                                etl_colocacion_resume
                            WHERE
                                yy = {$this->getYy()}
                            AND 
                                periodo = {$this->getPeriodo()}
                            AND 
                                Producto<>'QUIROGRAFARIO'
                            AND
                                IDTipoCte<>2
                            AND
                                IDTipoCte<>4      
                            GROUP BY
                                IDEjecutivo,
                                clave
                            ORDER BY
                                IDEjecutivo,
                                clave");

                }

            }
            
            
            while($filas=$query->fetch_assoc()){
                $this->colEjecutivos[]=$filas;
            }
            return $this->colEjecutivos;
        }
        public function get_colocacionZonas(){
            if($this->tipocte){
                if($this->tipocto){
                    $query=$this->db->query("SELECT
                                    zona,
                                    periodo,
                                    TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                                FROM
                                    etl_colocacion_resume
                                WHERE
                                    yy = {$this->getYy()}
                                GROUP BY
                                    zona,
                                    periodo");
                }else{
                    $query=$this->db->query("SELECT
                                    zona,
                                    periodo,
                                    TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                                FROM
                                    etl_colocacion_resume
                                WHERE
                                    yy = {$this->getYy()}
                                AND
                                    Producto<>'QUIROGRAFARIO'    
                                GROUP BY
                                    zona,
                                    periodo");
                }
            }else{
                if($this->tipocto){
                    $query=$this->db->query("SELECT
                                    zona,
                                    periodo,
                                    TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                                FROM
                                    etl_colocacion_resume
                                WHERE
                                    yy = {$this->getYy()}
                                AND
                                    IDTipoCte<>2
                                AND
                                    IDTipoCte<>4     
                                GROUP BY
                                    zona,
                                    periodo");

                }else{
                    $query=$this->db->query("SELECT
                                    zona,
                                    periodo,
                                    TRUNCATE (SUM(Monto) / 1000, 0) AS Monto
                                FROM
                                    etl_colocacion_resume
                                WHERE
                                    yy = {$this->getYy()}
                                AND
                                    Producto<>'QUIROGRAFARIO'
                                AND
                                    IDTipoCte<>2
                                AND
                                    IDTipoCte<>4     
                                GROUP BY
                                    zona,
                                    periodo");
                }
            }
            

            while($filas=$query->fetch_assoc()){
                $this->colZonas[]=$filas;
            }
            return $this->colZonas;
        }

        
    }
    