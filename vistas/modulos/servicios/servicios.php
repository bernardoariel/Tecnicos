 <?php

    $item = null;
    $valor = null;
    $orden = null;
    $forma = null;

          switch ($_GET["vista"]) {
            case "pendientes":
                $estado = 1;
               echo'<table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">
         
                <thead>
                   
                   <tr>
                     
                    <th style="background-color:#BBDEFB">#</th>
                    <th style="width: 100px; background-color:#BBDEFB">Fecha</th>
                    <th style="background-color:#BBDEFB">Cliente</th>
                    <th style="background-color:#BBDEFB">Producto</th>
                    <th style="background-color:#BBDEFB">Problema</th>
                    <th style="background-color:#BBDEFB">Producto Info</th>
                    <th style="width: 50px;background-color:#BBDEFB">Presupuesto</th>
                    <th style="width: 100px;background-color:#BBDEFB">Acciones</th>
          
                   </tr> 
          
                  </thead>
          
                  <tbody>';
                break;
            case "reparacion":
                $estado = 2;
                echo '<table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">
         
                        <thead>
                        
                        <tr>
                        
                        <th style="background-color:#FFD180">#</th>
                        <th style="width: 100px;background-color:#FFD180">Cliente</th>
                        <th style="width: 60px;background-color:#FFD180">Producto</th>
                        <th style="width: 100px;background-color:#FFD180">Problema 1</th>
                        <th style="width: 50px;background-color:#FFD180">Presupuesto</th>
                        <th style="background-color:#FFD180">Reparacion</th>
                        <th style="width: 50px;background-color:#FFD180">Precio</th>
                        <th style="width: 100px;background-color:#FFD180">Acciones</th>
                
                        </tr> 
                
                        </thead>
                
                        <tbody>';
                break;
            case "terminado":
                $estado = 3;

                echo '<table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">

                <thead>
               
                 <tr>
               
                  <th style="background-color:#C8E6C9">#</th>
                  <th style="width: 100px;background-color:#C8E6C9">Cliente</th>
                  <th style="width: 60px;background-color:#C8E6C9">Producto</th>
                  <th style="width: 100px;background-color:#C8E6C9">Problema 1</th>
                  <th style="width: 50px;background-color:#C8E6C9">Presupuesto</th>
                  <th style="background-color:#C8E6C9">Reparacion</th>
                  <th style="width: 50px;background-color:#C8E6C9">Precio</th>
                  <th style="width: 100px;background-color:#C8E6C9">Acciones</th>
               
                 </tr>
               
                </thead>
               
                <tbody>';
                break;
              
              default:
                  # code...
                  break;
          }
          
          
          if(isset($_GET["orden"])){
            
            $orden = "fecha";//$_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = "id";
            $forma = "ASC";
          }


        
          $servicios = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
        

          foreach ($servicios as $key => $value){
               

                switch ($estado) {

                    case 1:
                        
                        if($key==0 && isset($_GET["orden"])){
                            echo '<tr>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-1">'.($key+1).'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-2">'.$value["fecha"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-3">'.$value["cliente"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-4">'.$value["producto"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-5">'.$value["problema"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-6">'.$value["producto_info"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-7">'.$value["presupuesto"].'</td>

                                    <td style="background-color:#E1F5FE;" id="tdpendientes-8">';

                                    echo '<div class="btn-group">
                                            
                                            <button class="btn btn-warning btn-flat  btnVerServicioEditar" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id"].'" title="Editar servicio"><i class="fa fa-pencil"></i></button>
                                            <button class="btn btn-info btnReparar btn-flat" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'"><i class="fa fa-wrench" title="Reparar Equipo"></i></button>
                                            <button class="btn btn-danger btnEliminarServicio btn-flat" idServicio="'.$value["id"].'" title="Eliminar este Servicio"><i class="fa fa-times"></i></button>

                                        </div>'; 

                            echo '  </td>

                                </tr>';

                            }else{

                            echo '<tr>

                                    <td>'.($key+1).'</td>

                                    <td>'.$value["fecha"].'</td>

                                    <td>'.$value["cliente"].'</td>

                                    <td>'.$value["producto"].'</td>

                                    <td>'.$value["problema"].'</td>

                                    <td>'.$value["producto_info"].'</td>

                                    <td>'.$value["presupuesto"].'</td>

                                    <td>';

                                echo '<div class="btn-group">
                                        
                                        <button class="btn btn-warning btnVerServicioEditar btn-flat" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id"].'" title="Editar servicio"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-info btnReparar btn-flat" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'"><i class="fa fa-wrench"  title="Reparar Equipo"></i></button>
                                        <button class="btn btn-danger btnEliminarServicio btn-flat" idServicio="'.$value["id"].'" title="Eliminar este Servicio"><i class="fa fa-times"></i></button>

                                        </div>'; 

                            echo '</td>

                                </tr>';

                            }
                        break;
                    case 2:
                        
                        if($key==0 && isset($_GET["orden"])){
                            echo '<center><pre>bucle de arriba'; print_r($key); echo '</pre></center>';
                            echo '<tr>
                
                                   <td style="background-color:#E1F5FE;" id="tdenservicio-1">'.($key+1).'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-2">'.$value["cliente"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-3">'.$value["producto"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-4">'.$value["problema"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-4">'.$value["presupuesto"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-4">'.$value["reparacion"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-6">'.$value["precio"].'</td>
                
                                    <td style="background-color:#E1F5FE;" id="tdenservicio-7">';
                
                                    echo '<div class="btn-group">
                                            
                                           
                
                                          </div>'; 
                
                            echo '  </td>
                
                                  </tr>';
                
                            }else{
                                
                            echo '<tr>
                
                                    <td>'.($key+1).'</td>
                
                                    <td>'.$value["cliente"].'</td>
                
                                    <td>'.$value["producto"].'</td>
                
                                    <td>'.$value["problema"].'</td>
                
                                    <td>'.$value["presupuesto"].'</td>
                
                                    <td>'.$value["reparacion"].'</td>
                
                                    <td>'.$value["precio"].'</td>
                
                                    <td>';
                
                                  echo '<div class="btn-group">
                                          
                                          <button class="btn btn-info btnAPendiente btn-flat" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'" title="Devolver este Servicio"><i class="fa  fa-mail-reply-all"></i></button>
                                          <button class="btn btn-danger btnTerminarServicio btn-flat" data-toggle="modal" data-target="#modalTerminarServicio" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'" title="Editar Servicio"><i class="fa fa-pencil"></i></button>
                                          
                                          
                
                                        </div>'; 
                
                            echo '</td>
                
                                </tr>';
                
                            }
                            break;
                    case 3:
                        if ($key == 0 && isset($_GET["orden"])) {

                            echo '<tr>
                        
                                           <td style="background-color:#E1F5FE;" id="tdenservicio-1">' . ($key + 1) . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-2">' . $value["cliente"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["producto"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["problema"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["presupuesto"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["reparacion"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-6">' . $value["precio"] . '</td>
                        
                                            <td style="background-color:#E1F5FE;" id="tdenservicio-7">';
                        
                            echo '<div class="btn-group">
                                                    
                                                   
                        
                                                  </div>';
                        
                            echo '  </td>
                        
                                          </tr>';
                           } else {
                        
                            echo '<tr>
                        
                                            <td>' . ($key + 1) . '</td>
                        
                                            <td>' . $value["cliente"] . '</td>
                        
                                            <td>' . $value["producto"] . '</td>
                        
                                            <td>' . $value["problema"] . '</td>
                        
                                            <td>' . $value["presupuesto"] . '</td>
                        
                                            <td>' . $value["reparacion"] . '</td>
                        
                                            <td>' . $value["precio"] . '</td>
                        
                                            <td>';
                        
                            echo '<div class="btn-group">
                                                  
                                          <button class="btn btn-info btnAServicio btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="Devolver a Servicio"><i class = "fa  fa-mail-reply-all" > </i> </button>
                                          
                                          <button class="btn btn-danger btnEntregado btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="Producto Entregado"><i class="fa  fa-external-link"></i></button>    
                                                  
                                   </div>';
                        
                            echo '</td>
                        
                                        </tr>';
                           }     
                    default:
                        # code...
                        break;
                }
                
            
  
          
        } // foreach

        ?>
   
        </tbody>

       </table>