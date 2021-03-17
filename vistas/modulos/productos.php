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

        <div class="box box-warning">

            <div class="box-header with-border">

                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarProducto">

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

                        if (isset($_GET["orden"])) {

                            $orden = $_GET["orden"];
                            $forma = "DESC";
                        } else {

                            $orden = null;
                            $forma = "ASC";
                        }

                        $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden, $forma);                   

                        foreach ($productos as $key => $value) {
                            

                            if ($key == 0 && isset($_GET["orden"])) {

                                echo '<tr>

                                    <td style="background-color:#E1F5FE;" id="tdproducto-1">' . ($key + 1) . '</td>

                                    <td style="background-color:#E1F5FE;" id="tdproducto-2">' . $value["nombre"] . '</td>

                                    <td style="background-color:#E1F5FE;" id="tdproducto-3">';

                                if ($value["id"] > 1) {

                                    echo '<div class="btn-group">
                            
                                        <button class="btn btn-warning btnVerProductoEditar btn-flat" data-toggle="modal" data-target="#modalEditarProducto" idProducto="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>

                                        <button class="btn btn-danger btnEliminarProducto btn-flat" idProducto="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                                    </div>';
                                }

                                echo '  </td>

                                </tr>';

                            } else {

                                echo '<tr>

                                        <td>' . ($key + 1) . '</td>

                                        <td>' . $value["nombre"] . '</td>

                                        <td>';

                                        if ($value["id"] >1) {

                                            echo '<div class="btn-group">
                          
                                              <button class="btn btn-warning btnVerProductoEditar btn-flat" data-toggle="modal" data-target="#modalEditarProducto" idProducto="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>

                                              <button class="btn btn-danger btnEliminarProducto btn-flat" idProducto="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                                                  </div>';
                                    }

                                    echo '</td>

                                </tr>';
                            }
                        } // foreach

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

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

                <div class="modal-header" style="background:#3c8dbc; color:white">

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
                    <button type="button" id="btnCrearProducto" class="btn btn-primary pull-right btn-flat">Guardar Producto</button>

                </div>

            </form>



        </div>

    </div>

</div>


<!--=====================================
      EDITAR Producto
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <form role="form" method="post" autocomplete="off">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#262626; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">editar producto</h4>

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

                                <input type="text" class="form-control input-lg" name="editarProducto" id="editarProducto" placeholder="Ingresar nombre" required>

                                <input type="hidden" id="idProductoEditar" name="idProductoEditar">

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

                    <button type="button" id="btnEditarProducto" class="btn btn-primary pull-right btn-flat">Guardar Servicio</button>

                </div>

            </form>

        </div>

    </div>

</div>