<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-danger">

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">

<thead>

 <tr>

  <th style="width: 15px;background-color:#F93154;color:aliceblue;">#</th>
  <th style="width: 90px;background-color:#F93154;color:aliceblue;">Fecha Ingreso</th>
  <th style="width: 200px;background-color:#F93154;color:aliceblue;">Nombre</th>
  <th style="width: 100px;background-color:#F93154;color:aliceblue;">Telefono</th>
  <th style="width: 100px;background-color:#F93154;color:aliceblue;">Producto</th>
  <th style="width: 100px;background-color:#F93154;color:aliceblue;">Estado</th>
  <th style="width: 50px;background-color:#F93154;color:aliceblue;">Precio</th>
  <th style="background-color:#F93154;color:aliceblue;">Acciones</th>

 </tr>

</thead>

<tbody>

 <?php

 $item = null;
 $valor = null;
 $orden = null;
 $forma = null;
 $estado = null;
 if (isset($_GET["orden"])) {

  $orden = $_GET["orden"];
  $forma = "DESC";

 } else {

  $orden = "fecha";
  $forma = "DESC";

 }


 $serviciosPendientes = ControladorServicios::ctrMostrarServiciosTodos($item, $valor, $orden, $forma, $estado);


 foreach ($serviciosPendientes as $key => $value) {

  switch ($value['estado']) {

    case 1:
      
      $estado = '<span class="label label-info">'.$value['estado'].'-Pendientes</span>';
      $link = "index.php?ruta=servicios&vista=pendientes";
      break;

    case 2:

      $estado = '<span class="label label-warning">'.$value['estado'].'-En reparacion</span>';  
      $link = "index.php?ruta=servicios&vista=reparacion";
      break;

    case 3:

      $estado = '<span class="label label-success">'.$value['estado'].'-Terminados</span>';  
      $link = "index.php?ruta=servicios&vista=terminado";
      break;

    case 4:

      $estado = '<span class="label label-danger">'.$value['estado'].'-Entregados</span>';  
      $link = 'entregados';
      break;  

    }

  if ($key == 0 && isset($_GET["orden"])) {

   echo '<tr>

                  <td style="background-color:#E1F5FE;" id="tdenservicio-1">' . ($key + 1) . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-2">' .substr($value["fechacreacion"], 0, 10).'</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["cliente"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["telefono"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["producto"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $estado . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["precio"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-7">';

   echo '<div class="btn-group">
                           
                          

                         </div>';

   echo '  </td>

                 </tr>';
  } else {

   echo '<tr>

                   <td>' . ($key + 1) . '</td>

                   <td>' . substr($value["fechacreacion"], 0, 10).'</td>

                   <td>' . $value["cliente"] . '</td>
                   <td>' . $value["telefono"] . '</td>
                   <td>' . $value["producto"] . '</td>
                   <td><a href="'.$link.'">' . $estado. '</a></td>


                   <td>' . $value["precio"] . '</td>  

                   <td>';

                echo '<div class="btn-group">
                  <button class="btn btn-default btn-flat btnVerCliente" data-toggle="modal" data-target="#modalVerCliente" cliente="' . $value["cliente"] .'" title="ver Cliente"><i class = "fa fa-user"></i></button>         
               
                
                 
                 <button class="btn btn-danger btnEntregado btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="impresion"><i class="fa fa-print"></i></button>    
                         
          </div>';

   echo '</td>
   
               </tr>';
  }
 } // foreach

 ?>

</tbody>

</table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
      VER CLIENTE
======================================-->

<div id="modalVerCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#262626; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" placeholder="Ingresar nombre" readonly>
                
                <input type="hidden" id="idClienteEditar" name="idClienteEditar">

              </div>

            </div>


            <!-- ENTRADA PARA LA DIRECCIÓN -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Ingresar dirección" readonly>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                 <!-- ENTRADA PARA EL TELÉFONO -->
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask readonly>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                
                <input type="text" class="form-control input-lg" name="editarObs" id="editarObs" placeholder="Ingresar Comentario" readonly>

              </div>

            </div>

          </div>

        </div>
      
       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

