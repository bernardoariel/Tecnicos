<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          
          Agregar producto

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:5%">#</th>
           <th style="width:80%">Nombre</th>
           <th style="width:15%">Acciones</th>
           
         </tr> 

        </thead>
        
        <tbody>

        <?php

          $item = null;
          $valor = null;
          $orden = "fechacreacion";

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);


       foreach ($productos as $key => $value){
          
          if($key==0 && isset($_GET["orden"])){
            
            echo ' <tr>
                    <td style="background-color:#E1F5FE;" id="id-1">'.($key+1).'</td>
                    <td style="background-color:#E1F5FE;" id="id-2">'.$value["nombre"].'</td>';
            echo   '<td style="background-color:#E1F5FE;" id="id-3">';

            if($value["id"]>1){


              echo '<div class="btn-group">
                          
                    <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button>

                  </div> ';
            }
            echo '
                  </td>
                </tr>';

          }else{

            echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>';
            echo   '<td>';

            if($value["id"]>1){


              echo '<div class="btn-group">
                          
                      <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProducto"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button>

                    </div> ';
            }
            echo '
                  </td>
                </tr>';

          }

        }


        ?> 

        </tbody>
       

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" class="perfilUsuario">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA nOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Ingresar nombre" required>


              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary">Guardar producto</button> -->

          <button type="button" id="crearProducto" class="btn btn-primary pull-right" data-dismiss="modal">Guardar producto</button>

        </div>

      </form>


    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#262626; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA nOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" required>

                <input type="hidden" id="idProductoEditar" name="idProductoEditar">

              </div>

            </div>


          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary">Guardar cambios</button> -->
          <button type="button" id="editarProducto" class="btn btn-primary pull-right" data-dismiss="modal">Guardar cambios</button>

        </div>

      </form>

    </div>

  </div>

</div>

