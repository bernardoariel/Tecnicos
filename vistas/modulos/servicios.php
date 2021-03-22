<?php include('ajax/modal.cliente.ajax.php'); ?>
<?php

  if (isset($_GET["vista"])){

    $vista = $_GET["vista"];

  }else{

    $vista = "pendiente";

  }
  
?>
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

    <div class="box box-danger">

      

      <div class="box-body">

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#pendientes" data-toggle="tab">Pendientes</a></li>
              <li><a href="#reparando" data-toggle="tab">En Reparacion</a></li>
              <li><a href="#terminado" data-toggle="tab">Terminado</a></li>
              <button class="btn btn-danger pull-left btn-flat" data-toggle="modal" data-target="#modalAgregarServicio">
                Agregar servicios
              </button>

              <li class="header pull-left" ><i class="fa fa-inbox"></i> Servicios</li>
            </ul>
            
            <div class="tab-content ">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="pendientes" style="position: relative;">
                <?php
                include("servicios/pendientes.php");
                ?>
              </div>
              <div class="chart tab-pane" id="reparando" style="position: relative;">
                <?php
                include("servicios/enservicio.php");
                ?>
              </div>
              <div class="chart tab-pane" id="terminado" style="position: relative;">
                <?php
                include("servicios/terminado.php");
                ?>
              </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->


        </section>
      </div>

    </div>

  </section>

</div>



<!--=====================================
      EDITAR SERVICIO
======================================-->

<div id="modalEditarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3F51B5; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <!-- ENTRADA PARA EL NOMBRE -->
          <div class="row">

            <div class="col-md-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioClienteEditar" id="servicioClienteEditar" placeholder="Ingresar nombre" readonly>

              </div>

            </div>
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="col-md-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioTelefonoEditar" id="servicioTelefonoEditar" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask readonly>

              </div>

            </div>

          </div>



          <!-- ENTRADA PARA EL CLIENTE -->
          <div class="form-group">

            <label>Producto</label>

            <select class="form-control input-lg" style="width: 100%;height: 50px;" name="servicioProductoEditar" id="servicioProductoEditar">

              <option value="0" id="editarProductoSelect">-</option>

              <?php

              /*=============================================
                //        MOSTRAR PRODUCUTOS
                //=============================================*/
              $item = null;
              $valor = null;
              $orden = null;
              $forma = "ASC";
              $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden, $forma);

              ?>

              <?php foreach ($productos as $key => $value) : ?>

                <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>

              <?php endforeach ?>

            </select>

          </div>


          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>Problema</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

              <textarea class="form-control input-lg inputNuevo" name="servicioProblemaEditar" id="servicioProblemaEditar"></textarea>

            </div>

          </div>

          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>Observaciones del Producto</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-search"></i></span>

              <textarea class="form-control input-lg inputNuevo" name="servicioProductoInfoEditar" id="servicioProductoInfoEditar"></textarea>

              <input type="hidden" name="servicioIdUsuarioEditar" id="servicioIdUsuarioEditar" value="<?php echo $_SESSION['id']; ?>">
              <input type="hidden" name="idServicioEditar" id="idServicioEditar">
            </div>

          </div>

          <!-- ENTRADA PARA EL PRESUPUESTO -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

              <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioPresupuestoEditar" id="servicioPresupuestoEditar" placeholder="Ingresar Presupuesto" required>

            </div>

          </div>

        </div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary">Guardar cliente</button> -->
          <button type="button" id="btnEditarServicio" class="btn btn-danger pull-right">Guardar Producto</button>

        </div>

      </form>



    </div>

  </div>

</div>

<!--=====================================
      FINALIZAR SERVICIO
======================================-->

<div id="modalTerminarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3F51B5; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Finalizar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <!-- ENTRADA PARA EL NOMBRE -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioClienteTerminar" id="servicioClienteTerminar" placeholder="Ingresar nombre" readonly>

            </div>

          </div>

          <!-- ENTRADA PARA EL NOMBRE -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

              <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioProductoTerminar" id="servicioProductoTerminar" placeholder="Ingresar Producto" readonly>

            </div>

          </div>
          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>Problema</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-commenting"></i></span>

              <textarea class="form-control input-lg inputNuevo" name="servicioProblemaTerminar" id="servicioProblemaTerminar" readonly></textarea>

            </div>

          </div>


          <label>Presupuesto</label>

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

            <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioPresupuestoTerminar" id="servicioPresupuestoTerminar" placeholder="Presupuesto" value=0 readonly>

          </div>



          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>¿Que se Hizo?</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-exclamation-triangle"></i></span>

              <textarea class="form-control input-lg inputNuevo" name="servicioProductoInfoTerminar" id="servicioProductoInfoTerminar"></textarea>

              <input type="hidden" name="servicioIdUsuarioTerminar" id="servicioIdUsuarioTerminar" value="<?php echo $_SESSION['id']; ?>">

              <input type="hidden" name="idServicioTerminar" id="idServicioTerminar">

            </div>
            <!-- ENTRADA PARA EL PRODUCTO -->
            <div class="form-group">

              <label>Precio</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioPrecioTerminar" id="servicioPrecioTerminar" placeholder="Ingresar El precio">

              </div>

            </div>

          </div>


        </div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary">Guardar cliente</button> -->

          <button type="button" class="btn btn-danger pull-right btnModalTerminarServicio" estadoTerminar="2">Guardar Servicio</button>

          <button type="button" class="btn btn-success pull-right btnModalTerminarServicio" estadoTerminar="3">Trabajo Terminado</button>

        </div>

      </form>



    </div>

  </div>

</div>