<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar gastos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar gastos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGasto">
          
          Agregar Gastos

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Observaciones</th>
           <th>importe</th>
           <th>acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $gastos = ControladorGastos::ctrMostrarGastos($item, $valor);

          foreach ($gastos as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>';
            
             echo   '<td class="text-uppercase">'.$value["obs"].'</td>';
             echo   '<td class="text-uppercase">'.$value["importe"].'</td>';
           
             echo   '<td>

                      <div class="btn-group">';
                          
                        // <button class="btn btn-warning btnEditarGasto" idGasto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>';

                       

             echo '<button class="btn btn-danger btnEliminarGasto" idGasto="'.$value["id"].'"><i class="fa fa-times"></i></button></div>  

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
MODAL AGREGAR GASTO
======================================-->

<div id="modalAgregarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR EL NOMBRE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="tipoGasto">
                  
                  <option value="">Selecionar Gasto</option>

                  <option value="COMPRA">COMPRA</option>

                  <option value="GABRIEL">GABRIEL</option>

                  <option value="ARIEL">ARIEL</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="obsGasto" placeholder="Ingresar Observacion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="importeGasto" placeholder="Ingresar Importe" required>

              </div>

            </div>
  
          </div>

        </div>
        
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Gasto</button>

        </div>

        <?php

          $crearGasto = new ControladorGastos();
          $crearGasto -> ctrCrearGasto();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EL MOVIMIENTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoMovimiento">

                  <option value="" id="editarMovimiento"></option>

                  <option value="SI">Si</option>

                  <option value="NO">No</option>

                  

                </select>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          // $editarCategoria = new ControladorCategorias();
          // $editarCategoria -> ctrEditarCategoria();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

    $borrarGasto = new ControladorGastos();
    $borrarGasto -> ctrBorrarGasto();
   
?>


