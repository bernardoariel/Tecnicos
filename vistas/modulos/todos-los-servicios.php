<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <!-- seleccionamos el modo -->
    <div id="divSelectModo" class="pull-left">

      <label for="selectModo"> Estado: </label>

      <select class="form-control input-lg"  id="selectModo">
        <option value="0">Todos</option>
        <option value="1">Pendientes</option>
        <option value="2">En Reparacion</option>
        <option value="3">Terminado</option>
        <option value="4">Entregado</option>

      </select>

    </div> 

    <!-- Seleccionamos la fecha-->
    <div class="form-group pull-left" id="myCalendario">
      
      <label for="daterange-btn"> Fecha: </label>

      <div class="input-group">
        <button type="button" class="btn btn-default form-control input-lg pull-left" id="daterange-btn">
          <span>
            <i class="fa fa-calendar"></i> Seleccionar Fecha
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
      </div>
    </div>
    <!-- /.form group -->
   

    <!-- Creamos un boton -->
    <button id="btnxls" class="btn btn-success btn-flat form-control input-lg pull-left"><i class="fa fa-file-excel-o"></i> - Descargar</button>
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-danger">

      <div class="box-body">
      
     
      <table class="table table-bordered table-striped dt-responsive tablaServiciosTodos" width="100%">

<thead>

 <tr>

  <th style="width: 15px;background-color:#F93154;color:aliceblue;">#</th>
  <th style="background-color:#F93154;color:aliceblue;">Fecha Ingreso</th>
  <th style="background-color:#F93154;color:aliceblue;">Nombre</th>
  <th style="background-color:#F93154;color:aliceblue;">Telefono</th>
  <th style="background-color:#F93154;color:aliceblue;">Producto</th>
  <th style="background-color:#F93154;color:aliceblue;">Estado</th>
  <th style="background-color:#F93154;color:aliceblue;">Precio</th>
  <th style="background-color:#F93154;color:aliceblue;">Acciones</th>

 </tr>

</thead>



</table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
      VER CLIENTE
======================================-->

<div id="modalVerCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#262626; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Cliente</h4>

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

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" placeholder="Ingresar nombre" readonly>
                
                <input type="hidden" id="idClienteEditar" name="idClienteEditar">

              </div>

            </div>


            <!-- ENTRADA PARA LA DIRECCIÓN -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Ingresar dirección" readonly>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                 <!-- ENTRADA PARA EL TELÉFONO -->
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask readonly>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                
                <input type="text" class="form-control input-lg" name="editarObs" id="editarObs" placeholder="Ingresar Comentario" readonly>

              </div>

            </div>

          </div>

        </div>
      
       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Salir</button>

        </div>

      </form>

    </div>

  </div>

</div>

<script>
moment.locale('es');
$('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Los Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        
        tServFecha1=start.format('YYYY-MM-DD');
      
        tServFecha2=end.format('YYYY-MM-DD');

        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))

        table.clear().draw();
        urlNueva="ajax/tabla-tls.ajax.php?tServEstado="+tServEstado+"&tServFecha1="+tServFecha1+"&tServFecha2="+tServFecha2;

        table.ajax.url( urlNueva).load();
      }
    )
</script>
