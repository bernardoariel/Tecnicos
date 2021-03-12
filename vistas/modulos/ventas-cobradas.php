<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Ver Cobranzas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ver Ventas </li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box cajaPrincipal">

      <div class="box-header with-border">

         <button type="button" class="btn btn-default pull-right" id="daterange-btn-cobradas">
           <span>

             <i class="fa fa-calendar"></i> Rango de Fecha

           </span>
           
           <i class="fa fa-caret-down"></i>

         </button>

      </div>
    
      
    <!-- ELEMENTOS COBRADOS -->
    
     <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          //DATOS DE TODAS LAS VENTAS DEL MES
          $respuesta = ControladorVentas::ctrRangoFechasVentasCobrados($fechaInicial, $fechaFinal);

          $totalCobrado = 0;

          $repuestosVendidosCobrados = 0;

          $gananciaTotalCobrado = 0;

          $miGananciaCobrada = 0;

          $serviciosTerceros = 0;

          $cantidadSericiosTerceros = 0;

          $tablaCobrada="";

          $serviciosRepuesto01 = 0;
          $serviciosRepuesto02 = 0;

          $gananciaTotalCobrado =0;

          // inicio el recorrido
          foreach ($respuesta as $key => $value) {

            // tomo los valores
            $fecha = $value["fechapago"];
            
            $nrofc = $value["nrofc"];

           $detalle =$value['detalle'];

            // valores para MostrarClientes
            $itemCliente = "id";

            $valorCliente = $value["id_cliente"];

            $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

            // nombre del cliente
            $cliente = $respuestaCliente["nombre"];

            //tomo los datos de los items
            $listaProducto= json_decode($value["productos"],true);
        
            foreach ($listaProducto as $key => $value2) {

              // TRAER EL STOCK
              $tablaProductos = "productos";

              $item = "id";
              $valor = $value2["id"];
              $orden = "id";

              $stock = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
              
              // VER QUE TIPO DE STOCK TIENE
              $item = "id";
              $valor = $stock["id_categoria"];

              $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
            

              $totalCobrado = $value2['total']+$totalCobrado; 
              
              // echo $value2['id'].' '.$value2['descripcion'].'- <strong>'.$categorias["movimiento"].'</strong><br>';
              if($categorias["movimiento"]=="SI"){
                 
                  //ESTE ES EL TOTAL DE LOS REPUESTOS
                  // $repuestosVendidosCobrados = $value2['total']+$repuestosVendidosCobrados; 

              }else{

                switch ($stock['codigo']) {
                  case '302':
                    $serviciosTerceros= $value2['total']+$serviciosTerceros; 

                    $cantidadSericiosTerceros++;

                    $serviciosRepuesto01 = $serviciosRepuesto01 + $value2['total'];
                    break;
                  case '501':
                    $serviciosTerceros= $value2['total']+$serviciosTerceros; 

                    $serviciosRepuesto02 = $serviciosRepuesto02 + $value2['total'];

                    $cantidadSericiosTerceros++;
                    break;
                  
                  default:
                     $gananciaTotalCobrado = $value2['total']+$gananciaTotalCobrado; 
                    break;
                }

                // if ($stock['codigo']==302){

                //     $serviciosTerceros= $value2['total']+$serviciosTerceros; 

                //     $cantidadSericiosTerceros++;

                //   }else{

                //     $gananciaTotalCobrado = $value2['total']+$gananciaTotalCobrado; 



                //   }
                
   
              }

                $tablaCobrada = $tablaCobrada . '<tr>
                        
                        <td>'.$key.'</td>
                        <td>'.$fecha.'</td>
                        <td>'.$nrofc.'</td>
                        <td>'.$cliente.'</td>
                        <td>'.$detalle.'</td>
                        <td>'.$value2['descripcion'].'</td>
                        <td>'.$value2['total'].'</td>

                      </tr>';
              }

            }
       ?>
    
   <div class="box-header with-border">
        
       <div class="row">

        
        <div class="col-md-3 col-sm-6 col-xs-12">

          <div class="info-box">

            <span class="info-box-icon bg-blue"><i class="fa fa-bar-chart"></i></span>

            <div class="info-box-content">

              <span class="info-box-text">Total Cobrado</span>
              <span class="info-box-number">$ <?php echo $totalCobrado;?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3 col-sm-6 col-xs-12">

          <div class="info-box">

            <span class="info-box-icon bg-green"><i class="fa fa-cog"></i></span>

            <div class="info-box-content">

              <span class="info-box-text">Repuestos Cobrados</span>
              <span class="info-box-number">$ <?php echo $totalCobrado-$gananciaTotalCobrado;?></span>


            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">

          <div class="info-box">

            <span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">

             <span class="info-box-text">Mi Ganancia Cobrada</span>
              <span class="info-box-number">$ <?php echo $gananciaTotalCobrado;?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
         <div class="col-md-3 col-sm-6 col-xs-12">

          <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-wrench"></i></span>

            <div class="info-box-content">

              <span class="info-box-text">Servicio Terceros</span>
              <span class="info-box-number"><center>$ <?php echo $serviciosTerceros;?></center></span>
              <span class="info-box-number"> <center><small><?php echo 'Gabi: $'.$serviciosRepuesto01." .-  Otros: $".$serviciosRepuesto02;?></small></center></span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
    </div>

  </div>
   
      
     
    <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>#</th>
           <th>Fecha</th>
           <th>Codigo</th>
           <th>Cliente</th>
           <th>Modelo</th>
           <th>Detalle</th>
           <th>Importe</th>
         
         </tr> 

        </thead>

        <tbody>

        <?php 

          echo $tablaCobrada;
               
        ?>

        </tbody>

      </table>


    </div>
    
    
  
  </section>  

</div>


