<?php
    class checadorModel{
        private $idPersonal;
        private $idTag;
        private $personal;
        private $claveTag;
        private $fecha;
        private $time;
        private $tipo;

        public function __construct(){
            $this->db=Conectar::conexion();
            $this->coloacionanual=array();
            $this->casa=2;
            $this->emp=4;
            
        }

        public function setidPersonal($idPersonal){
            $this->idPersonal=$idPersonal;
        }
        public function setidTag($idTag){
            $this->idTag=$idTag;
        }
        public function setpersonal($personal){
            $this->personal=$personal;
        }
        public function setclaveTag($claveTag){
            $this->claveTag=$claveTag;
        }
        public function setfecha($fecha){
            $this->fecha=$fecha;
        }
        public function settime($time){
            $this->time=$time;
        }
        public function settipo($tipo){
            $this->tipo=$tipo;
        }
        public function getidPersonal(){
            return $this->idPersonal;
        }
        public function getidTag(){
            return $this->idTag;
        }
        public function getpersonal(){
            return $this->personal;
        }
        public function getclaveTag(){
            return $this->claveTag;
        }
        public function getfecha(){
            return $this->fecha;
        }
        public function gettime(){
            return $this->time;
        }
        public function gettipo(){
            return $this->tipo;
        }
        public function get_datos_personal(){
            if($this->claveTag){
                $sql="SELECT
                B.IDTag,
                B.IDPersonal,
                A.clave_tag,
                CONCAT(
                    C.Nombre,
                    ' ',
                    C.Apellido1,
                    ' ',
                    C.Apellido2
                ) AS Personal
                FROM
                    humanresources.tags A
                INNER JOIN humanresources.relacion_tag B ON A.ID = B.IDTag
                INNER JOIN sibware.personal C ON B.IDPersonal = C.ID
                WHERE
                    A.lActivo = 'S'
                AND C.`status` = 'S'
                and A.clave_tag='{$this->getclaveTag()}'";
                
                $query=$this->db->query($sql);
                
                return $query->fetch_object();
            }
        }
        public function checar(){
            $sql="INSERT INTO asistencias (
                IDPersonal,
                IDTag,
                Personal,
                ClaveTag,
                fecha,
                hora,
                tipo
                )
                VALUES
                (
                    {$this->getidPersonal()},
                    {$this->getidTag()},
                    '{$this->getpersonal()}',
                    '{$this->getclaveTag()}',
                    CURDATE(),
                    CURTIME(),
                    '{$this->gettipo()}'
                )";
             
            $insert=$this->db->query($sql);
            $result=false;
            if($insert){
                $_SESSION['personal']=$this->getpersonal();
                $_SESSION['time']=$this->gettime();
                $_SESSION['tipo']=$this->gettipo();
                $result=true;
            }  
            return $result; 
        }

        public function tipoAcceso(){
            $sql="SELECT
                *
                FROM
                    asistencias
                WHERE
                    IDPersonal = {$this->getidPersonal()}
                AND fecha = CURDATE()
                ORDER BY
                    ID DESC
                LIMIT 1";
            $query=$this->db->query($sql);
                
            return $query->fetch_object();
        }
    }