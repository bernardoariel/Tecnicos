<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Remitos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Remitos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <?php 

          $item =null;
          $valor=null;
          $respuesta = ControladorVentas::ctrBorrarFacturasSeleccionadas($item, $valor);
          

          ?>
          <table class="table table-bordered tablaVentasSeleccionadas">
            <thead>
              <tr>
                <th>#</th>
                <th>Codigo</th>
                <th>Cliente</th>
                <th>Detalle</th>
                
              </tr>
            </thead>
            <tbody id="datosFcSeleccionadas">
            
            

            </tbody>
          </table>
          


        </div>
        
        <div id="btnImprimir">
          
              <center>

                <!-- <a href="ajax/imprimiremito.php" target="_blank"> -->

                  <button class="btn btn-danger" id="imprimirEtiqueta">Imprimir Remito</button>


                <!-- </a> -->
                
                <a href="remitos">

                  <button class="btn btn-primary">Remitos</button>

                </a>

              </center>

        </div>
        
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaSeleccionarVentas">
              
               <thead>

                 <tr>
                   <th style="width:10px">#</th>
                   <th>Fecha</th>
                   <th>NroFc</th>
                   <th>Cliente</th>          
                   <th>Detalle</th>
                   <th>Importe</th>
               
                   <th>Acciones</th>
                </tr>

              </thead>

              <tbody>

                <?php

          $respuesta = ControladorVentas::ctrRemitosVentas();

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>'.$value["nrofc"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                 

               

           echo   '<td>'.$value["detalle"].'</td>

                  <td>'.$value["total"].'</td>

                 

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnSeleccionarFacturaRemito" idVenta="'.$value["id"].'">

                        <i class="fa fa-check-square-o"></i>

                      </button>';

                     // if ($value["adeuda"]==0){
                     //  echo '<button class="btn btn-disabled"><i class="fa fa-pencil"></i></button>';
                     // }else{
                     //   echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                     // }

                  

                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>

              </tbody>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>


