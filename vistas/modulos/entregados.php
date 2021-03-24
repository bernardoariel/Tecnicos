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

    <div class="box box-dark">

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">

<thead>

 <tr>

  <th style="width: 15px;background-color:#424242;color:aliceblue;">#</th>
  <th style="width: 90px;background-color:#424242;color:aliceblue;">Fecha Entrega</th>
  <th style="width: 200px;background-color:#424242;color:aliceblue;">Nombre</th>
  <th style="background-color:#424242;color:aliceblue;">Reparacion</th>
  <th style="width: 50px;background-color:#424242;color:aliceblue;">Precio</th>
  <th style="width: 90px;background-color:#424242;color:aliceblue;">Acciones</th>

 </tr>

</thead>

<tbody>

 <?php

 $item = null;
 $valor = null;
 $orden = null;
 $forma = null;
 $estado = 4;
 if (isset($_GET["orden"])) {

  $orden = $_GET["orden"];
  $forma = "DESC";
 } else {

  $orden = "fecha";
  $forma = "DESC";
 }


 $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma, $estado);


 foreach ($serviciosPendientes as $key => $value) {

  

  if ($key == 0 && isset($_GET["orden"])) {

   echo '<tr>

                  <td style="background-color:#E1F5FE;" id="tdenservicio-1">' . ($key + 1) . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-2">' .substr($value["fecha"], 0, 10).'</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["cliente"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["reparacion"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["precio"] . '</td>

                   <td style="background-color:#E1F5FE;" id="tdenservicio-7">';

   echo '<div class="btn-group">
                           
                          

                         </div>';

   echo '  </td>

                 </tr>';
  } else {

   echo '<tr>

                   <td>' . ($key + 1) . '</td>

                   <td>' . substr($value["fecha"], 0, 10).'</td>

                   <td>' . $value["cliente"] . '</td>

                   <td>' . $value["reparacion"] . '</td>

                   <td>' . $value["precio"] . '</td>  

                   <td>';

   echo '<div class="btn-group">
                         
                 <button class="btn btn-info btnAServicio btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="ver datos"><i class = "fa fa-building"> </i> </button>
                 
                 <button class="btn btn-danger btnEntregado btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="impresion"><i class="fa  fa-file-pdf-o"></i></button>    
                         
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

