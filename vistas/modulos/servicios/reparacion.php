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
<table class="table table-bordered table-striped dt-responsive tablaServiciosReparacion" width="100%">
         
        <thead>
         
         <tr>
           
          <th style="background-color:#FFD180">#</th>
          <th style="width: 100px;background-color:#FFD180">Cliente</th>
          <th style="width: 60px;background-color:#FFD180">Producto</th>
          <th style="width: 100px;background-color:#FFD180">Problema 1</th>
          <th style="width: 50px;background-color:#FFD180">Presupuesto</th>
          <th style="background-color:#FFD180">Reparacion</th>
          <th style="width: 50px;background-color:#FFD180">Precio</th>
          <th style="width: 100px;background-color:#FFD180">Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;
          $orden = null;
          $forma = null;
          $estado = 2;
          if(isset($_GET["orden"])){
            
            $orden = "fecha";//$_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = "id";
            $forma = "ASC";
          }

        
          $serviciosReparacion = ControladorServicios::ctrMostrarServicios($item, $valor, $orden, $forma,$estado);
          

          foreach ($serviciosReparacion as $key => $value) {
            
          

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["cliente"].'</td>

                    <td>'.$value["producto"].'</td>

                    <td>'.$value["problema"].'</td>

                    <td>'.$value["presupuesto"].'</td>

                    <td>'.$value["reparacion"].'</td>

                    <td>'.$value["precio"].'</td>

                    <td>';

                  echo '<div class="btn-group">
                          
                          <button class="btn btn-info btnAPendiente btn-flat" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'" title="Devolver este Servicio"><i class="fa  fa-mail-reply-all"></i></button>
                          <button class="btn btn-danger btnTerminarServicio btn-flat" data-toggle="modal" data-target="#modalTerminarServicio" idServicio="'.$value["id"].'" idUsuario="'.$_SESSION["id"].'" title="Editar Servicio"><i class="fa fa-pencil"></i></button>
                          
                          

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
var table = $('.tablaServiciosReparacion').DataTable({
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
$(".tablaServiciosReparacion tbody").on("click", "button.btnAPendiente", function(){

var idServicioEnviarReparar = $(this).attr("idServicio");
var idServicioUsuarioReparar = $(this).attr("idUsuario");


var servicios = new FormData();

servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
servicios.append("idSercicioEstado",  2);

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

            title: 'Devuelve '+respuesta["producto"]+' \n'+respuesta["cliente"]+'?\n - - a Pendientes - -',
            text: "¡Si no lo está puede cancelar la accíón!",
            type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, devolver a pendiente!'
                }).then(function(result) {
                
                if (result.value) {

                  var datos = new FormData();
                  datos.append("idServicioUsuarioReparar", idServicioUsuarioReparar);
                  datos.append("idServicioCambiarEstado", idServicioEnviarReparar);
                  datos.append("idServicioEstado", 1);//enviamos el 2
                  
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
                            title: "El Trabajo se ha enviado a Pendientes",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                              
                              if (result.value) {

                                window.location = "index.php?ruta=servicios&vista=pendientes";

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
                                window.location = "index.php?ruta=servicios&vista=pendientes";
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

$(".tablaServiciosReparacion tbody").on("click", "button.btnTerminarServicio", function(){
  //tomo el valor del servicio...
  $('#idServicioTerminar').val($(this).attr("idServicio"));
  
  var idServicioEnviarReparar = $(this).attr("idServicio");
  var idServicioUsuarioReparar = $(this).attr("idUsuario");

  var servicios = new FormData();

  servicios.append("idVerServicioEditar",  $(this).attr("idServicio"));
  servicios.append("idSercicioEstado",  2);

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

        $("#servicioClienteTerminar").val(respuesta["cliente"]);
        $("#servicioProductoTerminar").val(respuesta["producto"]);
        $("#servicioProblemaTerminar").val(respuesta["problema"]);
        $("#servicioPresupuestoTerminar").val(respuesta["presupuesto"]);
        $("#servicioPrecioTerminar").val(respuesta["precio"]);
        $("#servicioProductoInfoTerminar").val(respuesta["reparacion"]);


      }//success
  })//ajax
 
})
</script>