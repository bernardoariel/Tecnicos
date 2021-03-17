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



  </section>
 
</div>
