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
              <th style="width: 90px;background-color:#424242;color:aliceblue;">Telefono</th>
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

            if (isset($_GET["orden"])){

              $orden = $_GET["orden"];
              $forma = "DESC";

            }else{

              $orden = "fecha";
              $forma = "DESC";

            }

            $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma, $estado);

            foreach ($serviciosPendientes as $key => $value){
              
              if ($key == 0 && isset($_GET["orden"])){

                echo '<tr>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-1">' . ($key + 1) . '</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-2">' .substr($value["fecha"], 0, 10).'</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-3">' . $value["cliente"] . '</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-2">' .$value["telefono"].'</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["reparacion"] . '</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-4">' . $value["precio"] . '</td>

                        <td style="background-color:#E1F5FE;" id="tdenservicio-7">';

                        echo '<div class="btn-group">

                        </div>';

                        echo '  </td>

                        </tr>';
              
              }else{

                echo '<tr>

                          <td>' . ($key + 1) . '</td>
                    
                          <td>' . substr($value["fecha"], 0, 10).'</td>
                    
                          <td>' . $value["cliente"] . '</td>
                    
                          <td>' . $value["telefono"] . '</td>
                    
                          <td>' . $value["reparacion"] . '</td>
                    
                          <td>' . $value["precio"] . '</td>  
                    
                          <td>';
                    
                          echo '<div class="btn-group">
                    
                          <button class="btn btn-info btnVerEntregado btn-flat" idServicioEntregado="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="ver datos" data-toggle="modal" data-target="#modalTerminadoServicio"><i class = "fa fa-building"> </i> </button>
                    
                          <button class="btn btn-danger btnEntregado btn-flat" idServicio="' . $value["id"] . '" idUsuario="' . $_SESSION["id"] . '" title="impresion"><i class="fa  fa-file-pdf-o"></i></button>    
                    
                          </div>';
                    
                          echo '</td>
          
                </tr>';
                
              }

            }

            ?>


          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
      MOSTRAR  SERVICIO  ENTREGADO
======================================-->

<div id="modalTerminadoServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3F51B5; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloH4"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <!-- ENTRADA PARA LA FECHA  -->
          <div class="form-group">

          <label>Fecha de Ingreso</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-calendar-check-o text-info"></i></span>

              <input type="text" class="form-control input-lg inputTerminadoPendiente"  id="fechaIngresoTerminado"  readonly>

            </div>

          </div>

          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-product-hunt text-info"></i></span>

              <input type="text" class="form-control input-lg inputNuevo inputTerminadoPendiente" id="productoNombreTerminado" readonly>

            </div>

          </div>
          <!-- ENTRADA PARA EL PROBLEMA -->
          <div class="form-group">

            <label>Problema (segun Cliente)</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-commenting text-info"></i></span>

              <textarea class="form-control input-lg inputNuevo inputTerminadoPendiente" id="problemaTerminado" readonly></textarea>

            </div>

          </div>

           <!-- ENTRADA PARA DESCRIPCION -->
           <div class="form-group">

            <label>Detalles (nuestra Vision)</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-commenting-o text-info"></i></span>

              <textarea class="form-control input-lg inputNuevo inputTerminadoPendiente" id="detallesTerminado" readonly></textarea>

            </div>

            </div>

          <!-- ENTRADA PARA PRESUPUESTO -->  
          <label>Presupuesto</label>

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-credit-card text-info"></i></span>

            <input type="text" class="form-control input-lg inputNuevo inputTerminadoPendiente" id="presupuestoTerminado" readonly>

          </div>

          <hr>

          <!-- ENTRADA PARA LA FECHA  -->
          <div class="form-group">

            <label>Fecha de Entrega</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-calendar-check-o text-success"></i></span>

              <input type="text" class="form-control input-lg inputTerminadoTerminado"  id="fechaEntregaTerminado"  readonly>

            </div>

          </div>
          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>¿Que se Hizo?</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-exclamation-triangle text-success"></i></span>

              <textarea class="form-control input-lg inputNuevo inputTerminadoTerminado" id="reparacionTerminado" readonly></textarea>

            </div>
            <!-- ENTRADA PARA EL PRODUCTO -->
            <div class="form-group">

              <label>Precio Cobrado</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar text-success"></i></span>

                <input type="text" class="form-control input-lg inputNuevo inputTerminadoTerminado" id="precioTerminado" readonly>

              </div>

            </div>

            <!-- TECNICO -->
            <div class="form-group">

              <label>Tecnico</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa  fa-user-secret text-danger"></i></span>

                <input type="text" class="form-control input-lg inputNuevo inputTerminadoTerminado2" id="usuarioReparar" readonly>

              </div>

            </div>

          </div>


        </div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Salir</button>

        </div>

      </form>



    </div>

  </div>

</div>
