<?php

class colocacionController {
    public function index(){
        require_once("models/colocacionModel.php");
            if(empty($_POST['yy']) || $_POST['yy']=='Año'){
                $yy=date('Y');
            }elseif(!empty($_POST['yy'])){
                $yy=$_POST['yy'];
            }
            if(empty($_POST['p']) || $_POST['p']=='Periodo'){
                $p=date('n');
            }elseif(!empty($_POST['p'])){
                $p=$_POST['p'];
            }
            if(empty($_POST['pro']) || $_POST['pro']=='Producto'){
                $pro="";
            }elseif(!empty($_POST['pro'])){
                $pro=$_POST['pro'];
            }
            if(empty($_POST['customSwitch1'])){
                $tipocte="";
            }elseif(!empty($_POST['customSwitch1'])){
                $tipocte=$_POST['customSwitch1'];
            }
            if(empty($_POST['customSwitch2'])){
                $tipocto="";
            }elseif(!empty($_POST['customSwitch2'])){
                $tipocto=$_POST['customSwitch2'];
            }
            $colocacion=new colocacionModel();
            $colocacion->setYy($yy);
            $colocacion->setPeriodo($p);
            $colocacion->setProducto($pro);
            $colocacion->setTipoCte($tipocte);
            $colocacion->setTipocto($tipocto);
            $datos=$colocacion->get_colocacionanual();
            $yy=$colocacion->getYy();
            $p=$colocacion->getPeriodo();
            $metas=$colocacion->get_metas();
            $tipocte=$colocacion->getTipoCte();
            $tipocto=$colocacion->getTipocto();
            $pro=$colocacion->getProducto();
            if($tipocte){
                echo "Sin Casa";
            }else{
                echo "Con Casa";
            }
                

        require_once 'views/dashboard/colocacion.php'; 
       }
}