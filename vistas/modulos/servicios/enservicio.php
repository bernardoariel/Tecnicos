<table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">
         
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

        <tbody>

        <?php

          $item = null;
          $valor = null;
          $orden = null;
          $forma = null;
          $estado = 2;
          if(isset($_GET["orden"])){
            
            $orden = $_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = "id";
            $forma = "ASC";
          }

        
          $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
          

          foreach ($serviciosPendientes as $key => $value) {
            
            if($key==0 && isset($_GET["orden"])){

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

            
          
        } // foreach

        ?>
   
        </tbody>

       </table>
