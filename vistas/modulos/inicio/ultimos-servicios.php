<div class="col-sm-12 col-lg-5">

    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-danger">

        <div class="box-header with-border">

            <div class="col-4-md">
                
                <h3 class="box-title">Ultimos Servicios</h3>

            </div>

            <div class="col-4-md">

                <a href="#" class="btn btn-sm btn-info btn-flat" data-toggle="modal" data-target="#modalAgregarServicio" id="llamarModal">Nuevo Servicio</a>

            </div>

            <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

            </div>

        </div>

        <?php
            $item = null;
            $valor = null;
            $order = 'fecha';
            $forma = 'DESC';
            $limite =5;
            $todosLosServicios = ControladorServicios::ctrMostrarServiciosTodos($item,$valor,$orden, $forma,$limite); 
            
        ?>

        <!-- /.box-header -->
        <div class="box-body">

            <div class="table-responsive">
        
                <table class="table no-margin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($todosLosServicios as $key => $value): ?>
                        <tr>
                            <td><a href="#"><?php echo $value['id']; ?></a></td>
                            <td><?php echo $value['cliente']; ?></td>

                            <?php
                            $tipoServicio = ControladorPlantilla::servicioEstado($value['estado']);
                            echo ' <td><a href="'.$tipoServicio['link'].'">' . $tipoServicio['estado']. '</a></td>';
                     

                            ?>

                            <td><?php echo $value['telefono']; ?></td>
                            
                        </tr>
                    
                    <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

            <a href="todos-los-servicios" class="btn btn-sm btn-default btn-flat pull-right" id="btn-inicioServicios">Ver todos los servicios</a>

        </div>
    <!-- /.box-footer -->
    </div>

</div>