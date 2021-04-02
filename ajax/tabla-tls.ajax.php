<?php
session_start();
require_once "../controladores/servicios.controlador.php";
require_once "../controladores/plantilla.controlador.php";
require_once "../modelos/servicios.modelo.php";

class TablaServicios{

  /*=============================================
  MOSTRAR LA TABLA DE SERVICIO
  =============================================*/ 

  public function mostrarTabla(){

    if(isset($_POST["tServEstado"])){

        $tServEstado=$_POST["tServEstado"];
        $tServFecha1=$_POST["tServFecha1"];
        $tServFecha2=$_POST["tServFecha2"];

    }else{  
        $tServEstado=0;
        $tServFecha1=null;
        $tServFecha2=null;

    }

    $respuesta = ControladorServicios::ctrFiltrarTodosLosRegistros($tServEstado,$tServFecha1,$tServFecha2);
    
    $primero ='{
			    "data": [';
    $segundo ='';

            foreach ($respuesta as $key => $value) {
             $segundo .= '[
                        "'.($key).'",
                        "'.$value["fecha"].'",
                        "'.$value["cliente"].'",
                        "'.$value["telefono"].'",
                        "'.$value["producto"].'",
                        "'.$value["producto_info"].'",
                        "'.$value["problema"].'",
                        "'.$value["id_usuario"].'",
                        "'.$value["presupuesto"].'",
                        "'.$value["precio"].'",
                        "'.$value["reparacion"].'",
                        "'.$value["estado"].'"
                        
                    ],';
            }
            $segundo = trim($segundo,",");
            $tercero = 	']		}';

            echo $primero.$segundo.$tercero;
			

  }

  /*=============================================
  MOSTRAR LA TABLA DE SERVICIO
  =============================================*/ 

  public function mostrarTablaTServicios(){

    $tServEstado=$_GET["tServEstado"];
    $tServFecha1=$_GET["tServFecha1"];
    $tServFecha2=$_GET["tServFecha2"];

    $servicios = ControladorServicios::ctrFiltrarTodosLosRegistros($tServEstado,$tServFecha1,$tServFecha2);
    
    $datosJson = '[]'; 
    if(!empty($servicios)){
      $datosJson = '{
        "data": [';
    
    for($i = 0; $i < count($servicios); $i++){ 

      $tipoServicio = ControladorPlantilla::servicioEstado($servicios[$i]["estado"]);
      $estado = "<a href='".$tipoServicio['link']."'>". $tipoServicio['estado']."</a>";
      
        $botones ="<div class='btn-group text-center'>";
        $botones.="<button class='btn btn-default btn-flat' btnVerClienteTServicios' data-toggle='modal' data-target='#modalVerCliente' idClienteTServicios='".$servicios[$i]["id"]."' title='ver Cliente'><i class = 'fa fa-user'></i></button>";
        $botones.="<button class='btn btn-danger btnEntregado btn-flat' idServicio='". $servicios[$i]["id"]."' idUsuario='".$_SESSION["id"]."' title='impresion'><i class='fa fa-print'></i></button>";
        $botones.="</div>";
        
        $datosJson .='[
            "'.($i+1).'",
            "'.$servicios[$i]["fecha"].'",
            "'.$servicios[$i]["cliente"].'",
            "'.$servicios[$i]["telefono"].'",
            "'.$servicios[$i]["producto"].'",
            "'.$estado.'",
            "'.$servicios[$i]["precio"].'",
            "'.$botones.'"
          ],';
      }

     $datosJson = substr($datosJson, 0, -1);

     $datosJson .=   '] 

     }';
    }

      

      
      
      echo $datosJson;

  }

}

/*=============================================
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
if(isset($_POST["sinParametros"])){
    
    $activar = new TablaServicios();
    $activar -> mostrarTabla();
  
  }
/*=============================================
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
if(isset($_GET["tServEstado"])){
    
    $activar = new TablaServicios();
    $activar -> mostrarTablaTServicios();

}
  
 
