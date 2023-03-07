<script type="text/javascript" src="public/js/bandeja.js"></script>
<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
  </script>
<style type="text/css">
    input.form-control{
        font-size:14px;
    }
</style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold">Caso #<?php echo $_GET['id']; ?></h6>
          <input type="hidden" value="<?=$_GET['id']?>" id="idGestion">
          <input type="hidden" value="<?=$_SESSION['id']?>" id="idUsuario">
        </div>
        <div class="card-body">
            <!--PRIMERA CAJA DATOS DEL CLIENTE -->
            <div class="card shadow mb-4">
                <a href="#datosCliente" class="card-header py-3 border-bottom-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="datosCliente"><h6 class="m-0 font-weight-bold" style="color:#858796;">Datos del cliente</h6>
                </a>
                <div class="collapse show" id="datosCliente">
                  <div class="card-body">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <span class="form-group">Nombre del cliente</span>
                                <input type="text" class="form-control" aria-describedby="nombre" name="nombre" id="nombre"  value="<?=$nombre?>" readonly />
                            </div>
                            <div class="col">
                                <span class="form-group">Apellido del cliente</span>
                                <input type="text" class="form-control" aria-describedby="apellido" name="apellido" id="apellido" value="<?=$apellido?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <span class="form-group">Cedula del cliente</span>
                                <input type="text" class="form-control" aria-describedby="cedula" name="cedula" id="cedula"  value="<?=$cedula?>" readonly />
                            </div>
                            <div class="col">
                                <span class="form-group">Teléfono Domicilio</span>
                                <input type="text" class="form-control" aria-describedby="telf_hab" name="telf_hab" id="telf_hab"  value="<?=$telf_hab?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <span class="form-group">Teléfono Celular</span>
                                <input type="text" class="form-control" aria-describedby="telf_cel" name="telf_cel" id="telf_cel"  value="<?=$telf_cel?>" readonly />
                            </div>
                            <div class="col">
                                <span class="form-group">Correo electrónico</span>
                                <input type="text" class="form-control" aria-describedby="correo" name="correo" id="correo"  value="<?=$correo?>" readonly />
                            </div>
                        </div>
                    </div>
                  </div> <!-- FIN DE LA TARJETA -->
                </div>
            </div>
            <!--SEGUNDA CAJA DATOS DEL CONTACTO-->
            <div class="card shadow mb-4">
                <a href="#datosContacto" class="card-header py-3 border-bottom-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="datosContacto"><h6 class="m-0 font-weight-bold" style="color:#858796;">Datos del contacto</h6>
                </a>
                <div class="collapse show" id="datosContacto">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Origen del contacto</span>
                                    <input type="text" class="form-control" aria-describedby="origenContacto" name="origenContacto" id="origenContacto"  value="<?=$origenContacto?>" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Tipo de contacto</span>
                                    <input type="text" class="form-control" aria-describedby="tipocontacto" name="tipocontacto" id="tipocontacto" value="<?=$tipocontacto?>" readonly />
                                </div>
                            </div>
                        </div>
                     </div> 
                </div>
            </div>
            <!--TERCERA CAJA DATOS DEL PAGO-->
            <div class="card shadow mb-4">
                <a href="#datosPago" class="card-header py-3 border-bottom-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="datosPago"><h6 class="m-0 font-weight-bold" style="color:#858796;">Datos de pago</h6>
                </a>
                <div class="collapse show" id="datosPago">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Tipo de suscriptor</span>
                                    <input type="text" class="form-control" aria-describedby="tipoSuscriptor" name="tipoSuscriptor" id="tipoSuscriptor"  value="<?=$tiposuscriptor?>" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Moneda</span>
                                    <input type="text" class="form-control" aria-describedby="moneda" name="moneda" id="moneda"  value="<?=$tipomoneda?>" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Codigo de referencia del pago</span>
                                    <input type="text" class="form-control" aria-describedby="referenciapago" name="referenciapago" id="referenciapago"  value="<?=$referenciapago?>" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Banco o medio de pago</span>
                                    <input type="text" class="form-control" aria-describedby="banco" name="banco" id="banco"  value="<?=$nombrebanco?>" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-6">Monto del pago</span>
                                    <input type="text" class="form-control" aria-describedby="montopago" name="montopago" id="montopago"  value="<?=$montopago?>" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CUARTA CAJA COMENTARIOS DE SEGUIMIENTO-->
            <div class="card shadow mb-4">
                <a href="#comentariosSeguimiento" class="card-header py-3 border-bottom-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="comentariosSeguimiento"><h6 class="m-0 font-weight-bold" style="color:#858796;">Comentarios de seguimiento</h6>
                </a>
                <div class="collapse show" id="comentariosSeguimiento">
                    <div class="card-body">
                        <?php if(!$comentario){
                            echo '<div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Fecha y hora</span>
                                    <input type="text" class="form-control" aria-describedby="fechaYhora" name="fechaYhora" id="fechaYhora" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Usuario</span>
                                    <input type="text" class="form-control" aria-describedby="usuario" name="usuario" id="usuario" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Estatus</span>
                                    <input type="text" class="form-control" aria-describedby="estatusSeguimiento" name="estatusSeguimiento" id="estatusSeguimiento" readonly />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Comentario</span>
                                    <textarea class="form-control" rows=3 maxlength="250" name="comentarios" id="comentarios" readonly></textarea>
                                </div>
                            </div>
                        </div>';}else{
                        foreach ($comentario as $c) {?>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Fecha y hora</span>
                                    <input type="text" class="form-control" aria-describedby="fechaYhora" name="fechaYhora" id="fechaYhora"  value="<?=$c['fecha']?>" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Usuario</span>
                                    <input type="text" class="form-control" aria-describedby="usuario" name="usuario" id="usuario"  value="<?=$c['user']?>" readonly />
                                </div>
                                <div class="col">
                                    <span class="form-group">Estatus</span>
                                    <input type="text" class="form-control" aria-describedby="estatusSeguimiento" name="estatusSeguimiento" id="estatusSeguimiento"  value="<?=$c['descripcion']?>" readonly />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <span class="form-group">Comentario</span>
                                    <textarea class="form-control" rows=3 maxlength="250" name="comentarios" id="comentarios" readonly><?=$c['observacion']?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php }} ?>
                    </div>
                </div>
            </div>

            <a href="?view=bandeja&mode=index" class="btn btn-dark btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span><span class="text">Volver</span></a>

            <button type="submit" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#modalActualiza"><span class="icon text-white-50"><i class="fas fa-flag"></i></span><span class="text">Actualizar</span></button>

        </div>
    </div>
</div>

<div class="modal fade" id="modalActualiza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cierre del Caso <strong>#<?=$_GET['id']; ?></strong></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col form-group">
                    <span class="col">Estatus</span>
                    <select class="selectpicker show-menu-arrow show-tick form-control" name="estatus" id="estatus" required>
                         <option value="" disabled selected style="display:none;">Seleccione...</option>
                         <option value="1">PENDIENTE</option>
                         <option value="3">RESUELTO</option>
                    </select>
                </div>
                <div class="col form-group">
                    <span class="col">Observaciones</span>
                    <textarea class="form-control" rows=3 maxlength="250" name="observaciones" id="observaciones" onkeyup="mayus(this);" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Descartar</button>
                <button class="btn btn-primary" type="button" id="btn-actualizar">Guardar</button>
            </div>
        </div>
    </div>
  </div>

  <!-- Modal confirmación de actualización -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirm">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" align="center">
          <div class="modal-header">
            <h4 align="center">Registro actualizado con exito</h4>
          </div>
          <div class="modal-body">     
            <h6 align="center">Por favor espere mientras se actualiza la página</h6>
            <img src="public/images/refresh.gif" alt="refresh" height="50px" width="50px"/>
          </div>
        </div>
      </div>
    </div>