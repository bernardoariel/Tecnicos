<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-success">

      <div class="box-header with-border">

        <button class="btn bg-olive btn-flat" data-toggle="modal" data-target="#modalAgregarCliente">
          
          Agregar cliente

        </button>


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaClientes" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Direccion</th>
           <th>Telefono</th>  
           <th>WhatsApp</th>  
           <th>Email</th>  
           <th>Obs</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          if(isset($_GET["orden"])){
            
            $orden = $_GET["orden"];
            $forma = "DESC";

          }else{

            $orden = null;
            $forma = "ASC";
          }

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor, $orden,$forma);

          foreach ($clientes as $key => $value) {

            
            
            if($key==0 && isset($_GET["orden"])){

            echo '<tr>

                    <td style="background-color:#E1F5FE;" id="tdclientes-1">'.($key+1).'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-2">'.$value["nombre"].'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-3">'.$value["direccion"].'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-4">'.$value["cod_pais"]." - ".$value["telefono"].'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-5">'.$value["whatsapp"].'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-6">';

                    if($value["email"]){echo $value["email"];}else{echo "NO POSEE";}
                    
                    echo '</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-7">'.$value["obs"].'</td>

                    <td style="background-color:#E1F5FE;" id="tdclientes-8">';

                  
                    echo '<div class="btn-group">
                            
                            <button class="btn btn-warning btn-flat btnVerClienteEditar" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btn-flat btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>

                          </div>'; 
                  

            echo '  </td>

                  </tr>';

            }else{

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["direccion"].'</td>

                    <td>'.$value["cod_pais"]." - ".$value["telefono"].'</td>

                    <td>'.$value["whatsapp"].'</td>
                  

                    <td>';

                    if($value["email"]){echo $value["email"];}else{echo "NO POSEE";}
                    
                    echo '</td>
                    <td>'.$value["obs"].'</td>

                    <td>';

                

                  echo '<div class="btn-group">
                          
                          <button class="btn btn-warning btn-flat btnVerClienteEditar" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btn-flat btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>'; 
                

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

           
            <!-- ENTRADA PARA LA DIRECCI??N -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg inputNuevo" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingresar direcci??n" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="form-group">

              <div class="row">

                <div class="col-md-3">

                  <label for="">Cod.Pais</label>

                  <div class="input-group">

                    <span class="input-group-addon"><input type="checkbox" class="checkbox" name="nuevoChkCodPais" id="nuevoChkCodPais" checked></span> 

                    <input type="text" class="form-control input-lg" name="nuevoCodPais" id="nuevoCodPais" placeholder="Ingresar codigo"  value="549"  readonly>

                  </div>

                </div>
             
                <div class="col-md-6">
                  
                  <label for="">Nro.Telefono</label>

                  <div class="input-group">
                    <!-- ENTRADA PARA EL TEL??FONO -->
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                    <input type="text" class="form-control input-lg inputNuevo" name="nuevoTelefono" id="nuevoTelefono"  placeholder="Ingresar tel??fono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                  </div>

                </div>

                <div class="col-md-3">

                  <label for="">Tiene Whatsapp?</label>

                  <div class="input-group">
                    <!-- ENTRADA PARA EL TEL??FONO -->
                    <div class="checkbox">

                      <label for="whatsapp">

                        <input type="checkbox" class="checkbox" name="nuevoWs" id="nuevoWs" checked>S??

                      </label>

                    </div>

                  </div>

                </div>
              
              </div> <!-- row -->
              
            </div>


            <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                
                <input type="text" class="form-control input-lg inputNuevo" name="nuevoObs" id="nuevoObs" placeholder="Ingresar Comentario">

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCI??N -->
            <div class="form-group">

              <div class="row">

                <div class="col-md-5">

                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                    <select name="nuevoConsultaMail" id="nuevoConsultaMail" class="form-control input-lg">

                      <option value="si">Tiene Email</option>
                      <option value="no" selected>No Tiene Email</option>
                      
                    </select>
                    
                  </div>
                
                </div>

                <div class="col-md-7">

                  <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> 
                      
                      <input type="text" class="form-control input-lg" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar Email" readonly>

                    </div>

                  </div>
                
                </div>
                
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
          <button type="button" id="btnCrearCliente" class="btn btn-primary pull-right btn-flat">Guardar Cliente</button>

        </div>

      </form>



    </div>

  </div>

</div>


<!--=====================================
      EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">
      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#262626; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">editar cliente</h4>

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

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" placeholder="Ingresar nombre" required>
                
                <input type="hidden" id="idClienteEditar" name="idClienteEditar">

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCI??N -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Ingresar direcci??n" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="form-group">

              <div class="row">

                <div class="col-md-3">

                  <label for="">Cod.Pais</label>

                  <div class="input-group">

                    <span class="input-group-addon"><input type="checkbox" class="checkbox" name="editarChkCodPais" id="editarChkCodPais" checked></span> 

                    <input type="text" class="form-control input-lg" name="editarCodPais" id="editarCodPais" placeholder="Ingresar codigo"  value="549"  readonly>

                  </div>

                </div>
             
                <div class="col-md-6">
                  
                  <label for="">Nro.Telefono</label>

                  <div class="input-group">
                    <!-- ENTRADA PARA EL TEL??FONO -->
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                    <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar tel??fono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                  </div>

                </div>

                <div class="col-md-3">

                  <label for="">Tiene Whatsapp?</label>

                  <div class="input-group">
                    <!-- ENTRADA PARA EL TEL??FONO -->
                    <div class="checkbox">

                      <label for="whatsapp">

                        <input type="checkbox" class="checkbox" name="editarWs" id="editarWs" checked>S??

                      </label>

                    </div>

                  </div>

                </div>
              
              </div> <!-- row -->
              
            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 
                
                <input type="text" class="form-control input-lg" name="editarObs" id="editarObs" placeholder="Ingresar Comentario">

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCI??N -->
            <div class="form-group">

              <div class="row">

                <div class="col-md-5">

                  <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                    <select name="editarConsultaMail" id="editarConsultaMail" class="form-control input-lg" >
                      <option value="si">Tiene Email</option>
                      <option value="no" selected>No Tiene Email</option>
                    </select>
                    
                  </div>
                
                </div>

                <div class="col-md-7">

                  <!-- ENTRADA PARA SELECCIONAR SU TIPO DE IVA -->
                  <div class="form-group">
                    
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> 
                      
                      <input type="text" class="form-control input-lg" name="editarEmail" id="editarEmail" placeholder="Ingresar Email" readonly>

                    </div>

                  </div>
                
                </div>
                
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

          <button type="button" id="btnEditarCliente" class="btn btn-primary btn-flat pull-right" >Guardar cliente</button>

        </div>

      </form>

    </div>

  </div>

</div>

