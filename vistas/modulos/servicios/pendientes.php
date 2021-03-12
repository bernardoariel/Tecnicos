<table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">
         
      <thead>
         
         <tr>
           
           <th>#</th>
           <th style="width: 100px;">Fecha</th>
           <th>Cliente</th>
           <th>Producto</th>
           <th>Problema</th>
           <th>Producto Info</th>
           <th style="width: 50px;">Presupuesto</th>
           <th style="width: 100px;">Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;
          $orden = null;
          $forma = null;
          $estado = 1;
          if(isset($_GET["orden"])){
            
            $orden = $_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = "id";
            $forma = "ASC";
          }

        
          $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
          

          foreach ($serviciosPendientes as $key => $value){
            
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
                            
                            <button class="btn btn-warning btnVerServicioEditar" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id"].'" title="Editar servicio"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-info btnReparar" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'"><i class="fa fa-wrench" title="Reparar Equipo"></i></button>
                            <button class="btn btn-danger btnEliminarServicio" idServicio="'.$value["id"].'" title="Eliminar este Servicio"><i class="fa fa-times"></i></button>

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
                          
                          <button class="btn btn-warning btnVerServicioEditar" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id"].'" title="Editar servicio"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-info btnReparar" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'"><i class="fa fa-wrench"  title="Reparar Equipo"></i></button>
                          <button class="btn btn-danger btnEliminarServicio" idServicio="'.$value["id"].'" title="Eliminar este Servicio"><i class="fa fa-times"></i></button>

                        </div>'; 

            echo '</td>

                </tr>';

            }
  
          
        } // foreach

        ?>
   
        </tbody>

       </table>
