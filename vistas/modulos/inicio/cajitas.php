<?php
    /*=============================================
        Mostramos  CLIENTES STATIC
    =============================================*/
    $item = null;
    $valor = null;
    $orden = "nombre";
    $forma = "ASC";
    $clientes = ControladorClientes::ctrMostrarClientes($item,$valor,$orden,$forma);

    /*=============================================
        Mostramos  PRODUCTOS STATIC
    =============================================*/
    $item = null;
    $valor = null;
    $orden = "nombre";
    $forma = "ASC";
    $productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden,$forma);

    $item = "fecha";
   
    $valor = date('Y').'-'.date('m').'-01 00:00:00';
    $ultimosServicios = ControladorServicios::ctrMostrarUltimosServicios($item,$valor); 

    /*=============================================
        Mostramos mes STATIC
    =============================================*/

    $mes = ControladorPlantilla::consultarMes(date('m'));
    
    ?>
<div class="col-sm-12 col-lg-3">

    <br><br>
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content">
            <center>
                <span class="info-box-text text-center"><strong>  Clientes  (<?php echo count($clientes); ?>)</strong></span>
                <button type="button" class="btn bg-olive btn-flat margin" data-toggle="modal" data-target="#modalAgregarCliente">Nuevo</button>
                <button type="button" class="btn bg-olive btn-flat margin" id="btn-inicioClientes">Todos</button>
            </center>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box">
        <span class="info-box-icon bg-blue"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
            <center>
                <span class="info-box-text text-center"><strong>  Servicios de <?php echo $mes; ?> (<?php echo count($ultimosServicios); ?>)</strong></span>
                <button type="button" class="btn bg-blue btn-flat margin" data-toggle="modal" data-target="#modalAgregarServicio">Agregar Servicio</button>
            </center>
        </div>
        <!-- /.info-box-content -->
    </div> 

    
     <!-- /.info-box -->
     <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-pricetag-outline"></i></span>

        <div class="info-box-content">
            <center>
                <span class="info-box-text text-center"><strong>  Productos  (<?php echo count($productos); ?>)</strong></span>
                <button type="button" class="btn bg-orange btn-flat margin" data-toggle="modal" data-target="#modalAgregarProducto">Nuevo</button>
                <button type="button" class="btn bg-orange btn-flat margin" id="btn-inicioProductos">Todos</button>
            </center>
        </div>
        <!-- /.info-box-content -->
    </div> 
</div>