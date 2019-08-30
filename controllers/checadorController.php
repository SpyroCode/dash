<?php
    class checadorController {
        public function index(){
            require_once("models/checadorModel.php");
            if($_POST){
                $claveTag=$_POST['pws'];
                $fecha=date('Y-m-d');
                $time=date("H:i");
                $checar = new checadorModel;
                $checar->setclaveTag($claveTag);
                $checar->setfecha($fecha);
                $checar->settime($time);
                $datos=$checar->get_datos_personal();
                if($datos){
                    $personal=$datos->Personal;
                    $idPersonal=$datos->IDPersonal;
                    $idTag=$datos->IDTag;
                    $checar->setidTag($idTag);
                    $checar->setpersonal($personal);
                    $checar->setidPersonal($idPersonal);
                    $tipoacceso=$checar->tipoAcceso();
                    
                    if(empty($tipoacceso)){
                        $tipo='E';
                        echo "vacio";
                    }elseif($tipoacceso){
                      $tipo=$tipoacceso->tipo; 
                      
                      if($tipo=='S' || $tipo==null){
                          $tipo='E';
                      }elseif($tipo=='E'){
                          $tipo='S';  
                      } 
                    }
                    $checar->settipo($tipo);                    
                    $result=$checar->checar();
                    
                    if($result){
                        $_SESSION['message']="SUCCESS";
                    }else{
                        $_SESSION['message']="FAILED";
                    }
                    
                    
                }else{
                    $_SESSION['message']="FAILED";
                }
                
            }else{
               $_SESSION['message']="READY"; 
            }
            
            

            require_once 'views/checador.php';
        }
    }