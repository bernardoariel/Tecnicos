<?php

  $item = null;
  $valor = null;
  $orden = null;
  $forma = null;
  $estado = 1;

  $orden = "id";
  $forma = "ASC";

  $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
  $cantidadPendientes = count($serviciosPendientes);

  $item = null;
  $valor = null;
  $orden = null;
  $forma = null;
  $estado = 2;
  $orden = "id";
  $forma = "ASC";
 
        
  $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
  $cantidadReparacion = count($serviciosPendientes);
  
  $item = null;
  $valor = null;
  $orden = null;
  $forma = null;
  $estado = 3;
  $orden = "id";
  $forma = "ASC";
 
        
  $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
  $cantidadTerminado = count($serviciosPendientes);

  $estado = 4;
  $fecha = date('Y-m-d');

  $serviciosPendientes = ControladorServicios::ctrMostrarServiciosDelDia($estado,$fecha);
  
  $totalPrecio = 0;
  foreach ($serviciosPendientes as $key => $value) {
    # code...
    $totalPrecio =$totalPrecio+$value["precio"];
  }
  
?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-12 col-lg-3">

        <div class="small-box bg-aqua">
          
          <div class="inner">
            
            <h3><?php echo $cantidadPendientes; ?></h3>

            <p>Trabajos Pendientes</p>
          
          </div>
          
          <div class="icon">
            
            <i class="fa fa-android"></i>
          
          </div>
          
          <a href="index.php?ruta=servicios&vista=pendiente" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>

      <div class="col-sm-12 col-lg-3">

        <div class="small-box bg-yellow">
          
          <div class="inner">
            
            <h3><?php echo $cantidadReparacion; ?></h3>

            <p>En Reparacion</p>
          
          </div>
          
          <div class="icon">
            
            <i class="fa fa-cogs"></i>
          
          </div>
          
          <a href="index.php?ruta=servicios&vista=reparacion" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>

      <div class="col-sm-12 col-lg-3">

        <div class="small-box bg-green">
          
          <div class="inner">
            
            <h3><?php echo $cantidadTerminado; ?></h3>

            <p>Trabajos Terminados</p>
          
          </div>
          
          <div class="icon">
            
            <i class="fa fa-quote-left"></i>
          
          </div>
          
          <a href="index.php?ruta=servicios&vista=terminado" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>

      <div class="col-sm-12 col-lg-3">

        <div class="small-box bg-maroon">
          
          <div class="inner">
            
            <h3>$  <?php echo $totalPrecio; ?></h3>

            <p> <?php echo count($serviciosPendientes); ?> Trabajos terminados en el día</p>
          
          </div>
          
          <div class="icon">
            
            <i class="fa fa-dollar"></i>
          
          </div>
          
          <a href="ventas" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>
    
    </div> 

    <div class="row">
      
      <div class="col-sm-12 col-lg-5">
    
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-danger">
            
            <div class="box-header with-border">

   
                <div class="col-4-md">
                  <h3 class="box-title">Ultimos Servicios</h3>
              
                </div>

                <div class="col-4-md">
                  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat">Nuevo Servicio</a>
                </div>

              
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <?php
              $item = null;
              $valor = null;
              $order = 'fecha';
              $forma = 'DESC';
              $limite =5;
              $todosLosServicios = ControladorServicios::ctrMostrarServiciosTodos($item,$valor,$orden, $forma,$limite); 
              // echo '<center><pre>'; print_r($todosLosServicios); echo '</pre></center>';
            ?>

            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Telefono</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($todosLosServicios as $key => $value): ?>
                    <tr>
                      <td><a href="#"><?php echo $value['id']; ?></a></td>
                      <td><?php echo $value['cliente']; ?></td>
                      
                      <?php
                        switch ($value['estado']) {

                          case 1:
                            echo '<td><span class="label label-info">'.$value['estado'].'-Pendientes</span></td>';
                            break;
                          case 2:
                            echo '<td><span class="label label-warning">'.$value['estado'].'-En reparacion</span></td>';  
                            break;
                          case 3:
                            echo '<td><span class="label label-success">'.$value['estado'].'-Terminados</span></td>';  
                            break;
                          case 4:
                            echo '<td><span class="label label-danger">'.$value['estado'].'-Entregados</span></td>';  
                            break;  
                          
                        }
                     
                      ?>
                      
                      <td>
                        <?php echo $value['telefono']; ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  
                  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Ver todos los servicios</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    </div>



  </section>
 
</div>
