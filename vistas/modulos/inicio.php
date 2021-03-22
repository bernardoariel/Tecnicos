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
      <?php include('inicio/cajas-superiores.php'); ?>
    </div>
    
    <div class="row">
    
      <?php include('ajax/modal.cliente.ajax.php'); ?>
      <?php include('inicio/ultimos-servicios.php'); ?>
      <?php include('inicio/cajitas.php'); ?>
      <?php include('inicio/productos-mas-vendidos.php'); ?>
      
    </div>
      
      
      

  </section>

</div>


<!--=====================================
      AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3D9970; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg inputNuevo" name="nuevoCliente" id="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

           
            <!-- ENTRADA PARA LA DIRECCIÓN -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg inputNuevo" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <div class="form-group">
              
              <div class="input-group">
                 <!-- ENTRADA PARA EL TELÉFONO -->
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg inputNuevo" name="nuevoTelefono" id="nuevoTelefono"  placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>


              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                
                <input type="text" class="form-control input-lg inputNuevo" name="nuevoObs" id="nuevoObs" placeholder="Ingresar Comentario">

              </div>

            </div>



          </div>

        </div>
      
       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary">Guardar cliente</button> -->
          <button type="button" id="btnCrearCliente" class="btn bg-olive pull-right btn-flat">Guardar Cliente</button>

        </div>

      </form>



    </div>

  </div>

</div>

<!--=====================================
      AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <form role="form" method="post" autocomplete="off">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#FF851B; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Producto</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg inputNuevo" name="nuevoProducto" id="nuevoProducto" placeholder="Ingresar nombre" required>

                            </div>

                        </div>


                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Salir</button>

                    <!-- <button type="submit" class="btn btn-primary">Guardar cliente</button> -->
                    <button type="button" id="btnCrearProducto" class="btn bg-orange pull-right btn-flat">Guardar Producto</button>

                </div>

            </form>



        </div>

    </div>

</div>