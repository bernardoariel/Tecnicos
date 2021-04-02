<?php
    class ControladorReportes{
        /*=============================================
       MOSTRAR REPORTE TODOS LOS SERVICIOS
       =============================================*/

       static public function ctrReportes($tServEstado,$tServFecha1,$tServFecha2){

        $tabla = "servicios";

        $respuesta = ModeloServicios::mdlFiltrarTodosLosRegistros($tabla,$tServEstado,$tServFecha1,$tServFecha2);

        $Name = 'reporte.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header('Content-Disposition:; filename="'.$Name.'"');
        header("Content-Transfer-Encoding: binary");

        echo utf8_decode("<table border='0'> 
                             <tr>
                             <td style='font-weight:bold; border:1px solid #eee;'>FECHA INGRESO</td>
                             <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>  
                             <td style='font-weight:bold; border:1px solid #eee;'>TELEFONO</td>
                             <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
                             <td style='font-weight:bold; border:1px solid #eee;'>DETALLES</td>
                             <td style='font-weight:bold; border:1px solid #eee;'>PROBLEMA</td>	
                             <td style='font-weight:bold; border:1px solid #eee;'>PRESUPUESTO</td>				
                             <td style='font-weight:bold; border:1px solid #eee;'>PRECIO</td>				
                             <td style='font-weight:bold; border:1px solid #eee;'>REPARACION</td>	
                             <td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>	
                             <td style='font-weight:bold; border:1px solid #eee;'>TECNICO</td>	
                             
                             </tr>");
        foreach ($respuesta as $key => $value){
          
            // if($item["id_usuario"]==0){

            //     $tecnico ="No Asignado";

            // }else{
                
                // $item = "id";
                // $valor=$item["id_usuario"];

                // $verTecnico = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                // $tecnico = $verTecnico["usuario"];
            // }
            if($value["id_usuario"]==0){

                $tecnico = "No Asignado";

            }else{

                $item = "id";
                $valor=$value["id_usuario"];

                $verTecnico = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                $tecnico = $verTecnico["usuario"];
 
            }
            
            echo utf8_decode("<tr>
                      <td style='border:1px solid #eee;'>".$value["fecha"]."</td> 
                      <td style='border:1px solid #eee;'>".$value["cliente"]."</td>
                      <td style='border:1px solid #eee;'>".$value["telefono"]."</td>
                      <td style='border:1px solid #eee;'>".$value["producto"]."</td>
                      <td style='border:1px solid #eee;'>".$value["producto_info"]."</td>
                      <td style='border:1px solid #eee;'>".$value["problema"]."</td>
                      <td style='border:1px solid #eee;'>".$value["presupuesto"]."</td>
                      <td style='border:1px solid #eee;'>".$value["precio"]."</td>
                      <td style='border:1px solid #eee;'>".$value["reparacion"]."</td>
                      <td style='border:1px solid #eee;'>".$value["estado"]."</td>
                      <td style='border:1px solid #eee;'>".$tecnico."</td>
                      </tr>");
                                   

              }
              echo "</table>";

        }      
    }