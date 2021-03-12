<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cuenta corriente
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cuenta corriente</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box cajaPrincipal">

      <div class="box-header with-border">
        

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial="'.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }         

        ?>
           
           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

<button type="button" class="btn btn-danger" id="btn-pagartodo">Pagar</button>

          </a>


        <button type="button" class="btn btn-default pull-right" id="daterange-btn">

           <span>
             <i class="fa fa-calendar"></i> Rango de Fecha
           </span>
           
           <i class="fa fa-caret-down"></i>
        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Nro. Factura</th>
           <th>Codigo</th>
           <th>Cliente</th>
          <!--  <th>Vendedor</th> -->
           <th>Forma de pago</th>
           <th>Detalle</th>
           <th>Total</th> 
           <th>Adeuda</th> 
           <th>Obs</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentasCtaCorriente($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>'.$value["codigo"].'</td>

                  <td>'.$value["nrofc"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                 

                 echo ' <td>'.$value["metodo_pago"].'</td>

                  <td>'.$value["detalle"].'</td>

                  <td>$ '.number_format($value["total"],2).'</td>';

                   if ($value["adeuda"]==0){
                            echo '<td style="color:green">$ '.number_format($value["adeuda"],2).'</td>';
                          }else{
                            echo '<td style="color:red">$ '.number_format($value["adeuda"],2).'</td>';
                          }

                 

                 echo '<td>'.$value["observaciones"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                        <i class="fa fa-print"></i>

                      </button>';

                       echo '<button class="btn btn-warning btnEditarPago" idVenta="'.$value["id"].'" data-toggle="modal" data-target="#modalAgregarPago"><i class="fa fa-money"></i></button>';
                     

                     

                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>
       

      </div>

    </div>

  </section>

</div>

<!--=====================================
      AGREGAR Pago
======================================-->

<div id="modalAgregarPago" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pago</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="hidden" class="form-control input-lg" name="idPago" id="idPago" required>
                <input type="hidden" class="form-control input-lg" name="adeuda" id="adeuda" required>

                <input type="text" class="form-control input-lg" name="nuevoPago" id="nuevoPago" placeholder="Ingresar Pago" required>

              </div>

            </div>

          
            



          </div>

        </div>
      
       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar pago</button>

        </div>

      </form>

       <?php

        $realizarPago = new ControladorVentas();
        $realizarPago -> ctrRealizarPago("ctacorriente");

      ?>


    </div>

  </div>
</div>