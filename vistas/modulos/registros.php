<div class="content-wrapper">

  <section class="content-header">

    <h1>
      
      Administrar Registros
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Registros</li>
    
    </ol>

  </section>

  <section class="content">
    
    <div class="col-lg-8">

      <div class="box">

        <div class="box-header with-border">
          
          <h2>Nro. de Comprobantes</h2>
          
        </div>

        <div class="box-body">
              
          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Nombre</th>
               <th>Valor</th>
               <th>Acciones</th>

             </tr> 

            </thead>

            <tbody>

              <?php

              $item = null;
              $valor = null;

              $comprobantes = ControladorComprobantes::ctrMostrarComprobantes($item, $valor);

             foreach ($comprobantes as $key => $value){
               
                echo ' <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["numero"].'</td>';

                        
                echo '<td>

                          
                              
                            <button class="btn btn-warning btnEditarComprobante" idComprobante="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarComprobante"><i class="fa fa-pencil"></i></button>

                        </td>

                      </tr>';
              }


              ?> 

            </tbody>

          </table>
              
        </div>

      </div>

    </div>
    
  </section>

</div>

<!--=====================================
MODAL EDITAR COMPROBANTE
======================================-->

<div id="modalEditarComprobante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Comprobante</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

         
            <!-- ENTRADA PARA EL NOMBRE -->
              
              <div class="form-group">
                
                <label for="editarRegistro">Valor:</label>  
                
                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 

                  <input type="text" class="form-control input-lg" name="editarRegistro" id="editarRegistro" placeholder="Ingresar registro"  required>

                  <input type="hidden" name="idComprobante" id="idComprobante" >

                </div>

              </div>

              

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary">Modificar Comprobante</button>

            </div>

        <?php

          $editarComprobante = new ControladorComprobantes();
          $editarComprobante -> ctrEditarComprobante();

        ?> 

      </form>

    </div>

  </div>

</div>







