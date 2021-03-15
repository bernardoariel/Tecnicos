<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar servicios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar servicios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">


      <div class="box-body">
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
          $estado = 4;
          $orden = "fechacreacion";
          $forma = "DESC";

          $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
          
          foreach ($serviciosPendientes as $key => $value){
            
          

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
                          

                        </div>'; 

            echo '</td>

                </tr>';

          
        } // foreach

        ?>
   
        </tbody>

       </table>
      </div></div>
  </section>
</div>
