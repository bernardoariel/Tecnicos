<!--=====================================
      AGREGAR SERVICIO
======================================-->
<div id="modalAgregarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#F93154; color:#FFF">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Servicio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <label id="bsqCliente">Cliente</label>
          <!-- ENTRADA PARA EL CLIENTE -->
          <div class="form-group" id="divSelect">

            <select id="selectCliente" class="form-control select2 input-lg" style="width: 100%;height: 50px;">

              <option value="0">-</option>
              <!-- <option value="OCACIONAL">OCACIONAL</option> -->

              <?php
                /*=============================================
                //        MOSTRAR CLIENTES
                //=============================================*/
                $item = null;
                $valor = null;
                $orden = null;
                $forma = "ASC";
                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor, $orden, $forma);
              ?>

              <?php foreach ($clientes as $key => $value) : ?>

                <option value="<?php echo $value['id']; ?>" id="0"><?php echo $value['nombre']; ?></option>

              <?php endforeach ?>

            </select>

          </div>

          <!-- ENTRADA PARA EL NOMBRE -->
          <div class="row">

            <div class="col-md-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg inputNuevo " name="servicioCliente" id="servicioCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="col-md-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioTelefono" id="servicioTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                <input type="hidden" name="idCLienteServicio" id="idCLienteServicio" value="1">

              </div>

            </div>

          </div>

          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>Producto</label>

            <select class="form-control input-lg" style="width: 100%;height: 50px;" name="servicioProducto" id="servicioProducto">

              <option value="0">-</option>
              
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

              <textarea class="form-control input-lg inputNuevo" name="servicioProblema" id="servicioProblema"></textarea>

            </div>

          </div>

          <!-- ENTRADA PARA EL PRODUCTO -->
          <div class="form-group">

            <label>Observaciones del Producto</label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-search"></i></span>

              <textarea class="form-control input-lg inputNuevo" name="servicioProductoInfo" id="servicioProductoInfo"></textarea>

              <input type="hidden" name="servicioIdUsuario" id="servicioIdUsuario" value="<?php echo $_SESSION['id']; ?>">

            </div>

          </div>

          <!-- ENTRADA PARA EL PRESUPUESTO -->
          <div class="form-group">

            <label>Presupuesto</label>
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

              <input type="text" class="form-control input-lg inputNuevo " onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" name="servicioPresupuesto" id="servicioPresupuesto" placeholder="Ingresar Presupuesto" required value="0">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" id="btnCrearServicio" class="btn btn-danger pull-right">Guardar Servicio</button>

        </div>

      </form>



    </div>

  </div>

</div>
