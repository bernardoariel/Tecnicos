<?php
session_start();
  #clientes
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
#productos
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

#empresa
require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";
?>
<table class="table table-bordered table-striped dt-responsive tablaServiciosPendientes" width="100%">
         
      <thead>
         
         <tr>
           
          <th style="background-color:#BBDEFB">#</th>
          <th style="width: 100px; background-color:#BBDEFB">Fecha</th>
          <th style="background-color:#BBDEFB">Cliente</th>
          <th style="background-color:#BBDEFB">Producto</th>
          <th style="background-color:#BBDEFB">Problema</th>
          <th style="background-color:#BBDEFB">Producto Info</th>
          <th style="width: 50px;background-color:#BBDEFB">Presupuesto</th>
          <th style="width: 100px;background-color:#BBDEFB">Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;
          $orden = null;
          $forma = null;
          $estado = 1;
          
          if(isset($_GET["orden"])){
            
            $orden = "fecha";//$_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = "id";
            $forma = "ASC";
          }


        
          $serviciosPendientes = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
        

          foreach ($serviciosPendientes as $key => $value){
            
            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["fecha"].'</td>

                    <td>'.$value["cliente"].'</td>

                    <td>'.$value["producto"].'</td>

                    <td>'.$value["problema"].'</td>

                    <td>'.$value["producto_info"].'</td>

                    <td>'.$value["presupuesto"].'</td>

                    <td>';

                  echo '<div class="btn-group">
                          
                          <button class="btn btn-warning btnVerServicioEditar btn-flat" data-toggle="modal" data-target="#modalEditarServicio" idServicio="'.$value["id"].'" title="Editar servicio"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-info btnReparar btn-flat" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'"><i class="fa fa-wrench"  title="Reparar Equipo"></i></button>
                          <button class="btn btn-danger btnEliminarServicio btn-flat" idServicio="'.$value["id"].'" title="Eliminar este Servicio"><i class="fa fa-times"></i></button>

                        </div>'; 

            echo '</td>

                </tr>';

  
          
        } // foreach

        ?>
   
        </tbody>

       </table>

<script>
/*=============================================
CARGAR LA TABLA 
=============================================*/
var table = $('.tablaServiciosPendientes').DataTable({
//  "ajax":"ajax/datatable-vocabulario.ajax.php",
 dom: 'lBfrtip',/*Bfrtip*/
      buttons: [
        {
          extend: 'colvis',
          columns: ':not(:first-child)',
        }
        ],
    "language": {

    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

  }

})
$("#tab1").children().children()[0].remove();
/*=============================================
VER SERVICIOS
=============================================*/
$(".tablaServiciosPendientes").on("click", ".btnVerServicioEditar", function(){
  //TOMO LA VARIABLE DEL BOTON
  var idVerServicioEditar = $(this).attr("idServicio");
  console.log("idVerServicioEditar", idVerServicioEditar);
  
  // LOS CARGO EN EL FORMDATA DE UN AJAX
  var datos = new FormData();
  datos.append("idVerServicioEditar", idVerServicioEditar);
  datos.append("idSercicioEstado", 1);
  //HAGO UN AJAX CON JSON
  $.ajax({
      url:"ajax/servicios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        // VEO LA RESPUESTA
        console.log("respuesta", respuesta);       
        //CARGO LA RESPUESTA EN LOS INPUT
        $("#idServicioEditar").val(respuesta["id"]);
        $("#servicioClienteEditar").val(respuesta["cliente"]);
        $("#servicioTelefonoEditar").val(respuesta["telefono"]);
        $("#servicioProblemaEditar").val(respuesta["problema"]);
        $("#servicioProductoInfoEditar").val(respuesta["producto_info"]);
        $("#servicioIdUsuarioEditar").val(respuesta["id_usuario_creacion"]);
        $("#servicioPresupuestoEditar").val(respuesta["presupuesto"]);
        $("#editarProductoSelect").html(respuesta["producto"]);
		    $("#editarProductoSelect").val(respuesta["id_producto"]);
      }//SUCESS
  })//AJAX

})

$(".tablaServiciosPendientes tbody").on("click", "button.btnReparar", function(){

var idServicioEnviarReparar = $(this).attr("idServicio");
var idServicioUsuarioReparar = $(this).attr("idUsuario");
console.log("idServicioEnviarReparar", idServicioEnviarReparar);

var servicios = new FormData();
servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
servicios.append("idSercicioEstado",  1);

$.ajax({
    url:"ajax/servicios.ajax.php",
    method: "POST",
    data: servicios,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      console.log("respuesta", respuesta);

       swal({

            title: '¿Repara '+respuesta["producto"]+' \n'+respuesta["cliente"]+'?',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, Enviar al servicio tecnico!'
                }).then(function(result) {
                if (result.value) {

                  var datos = new FormData();
                  datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
                  datos.append("idServicioCambiarEstado", idServicioEnviarReparar);
                  datos.append("idServicioEstado", 2);//enviamos el 2
                  

                  $.ajax({

                      url:"ajax/servicios.ajax.php",
                      method: "POST",
                      data: datos,
                      cache: false,
                      contentType: false,
                      processData: false,
                      success:function(respuesta){
                        console.log("respuesta", respuesta);

                        if(respuesta=="ok"){

                          swal({
                            type: "success",
                            title: "Enviado al Servicio Tecnico",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                              
                              if (result.value) {

                                window.location = "index.php?ruta=servicios&vista=reparacion";

                              }

                            })
                          
                          }else{
                            swal({
                              type: "error",
                              title: "No se puede Enviar",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                              if (result.value) {

                                window.location = "index.php?ruta=servicios&vista=reparacion";
                              }
                            })
                          }
                      }//sucess
                  })//ajax
                }//dentro del swal
          })//swal
    }//success
  })//ajax

})
/*=============================================
ELIMINAR SERVICIOS
=============================================*/

$(".tablaServiciosPendientes tbody").on("click", "button.btnEliminarServicio", function(){

var idServicioEliminar = $(this).attr("idServicio");
console.log("idServicioEliminar", idServicioEliminar);

var servicios = new FormData();
servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
servicios.append("idSercicioEstado",  1);

$.ajax({
    url:"ajax/servicios.ajax.php",
    method: "POST",
    data: servicios,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      console.log("respuesta", respuesta);
       swal({
            title: '¿Está seguro de eliminar el servicio de '+respuesta["cliente"]+' \n'+respuesta["producto"]+'?',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, borrar servicio!'
                }).then(function(result) {
                if (result.value) {
                  var datos = new FormData();
                  datos.append("idServicioEliminar", idServicioEliminar);
                  datos.append("nombreServicioProducto", respuesta["producto"]);

                  $.ajax({
                      url:"ajax/servicios.ajax.php",
                      method: "POST",
                      data: datos,
                      cache: false,
                      contentType: false,
                      processData: false,
                      success:function(respuesta){
                        console.log("respuesta", respuesta);
                        if(respuesta=="ok"){
                          swal({
                            type: "success",
                            title: "El servicio ha sido ELIMINADO correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                              if (result.value) {
                                window.location = "index.php?ruta=servicios&vista=pendiente";
                              }
                            })
                          }else{
                            swal({
                              type: "error",
                              title: "No se puede Eliminar",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                              if (result.value) {
                                window.location = "index.php?ruta=servicios&vista=pendiente";
                              }
                            })
                          }
                      }//sucess
                  })//ajax
                }//dentro del swal
          })//swal
    }//success
  })//ajax

})
</script>
