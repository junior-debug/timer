<!--style>
  th,td{
    text-align: center;
    font-size: 14px;
  }
</style-->

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold text-dark">USUARIOS REGISTRADOS</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <!--th>Nombre de usuario</th-->
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Cargo</th>
                        <th>Fecha Ingreso</th>
                        <th>Servicio</th>
                        <th>Campaña</th>
                        <th>Rotación</th>
                        <th>Turno</th>
                        <th>Editar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($listUser as $u) {?>
                        <td><?php echo $u['id_datos_empleados'];?></td>
                        <td><?php echo $u['nombre'];?></td>
                        <td><?php echo $u['apellido'];?></td>
                        <td><?php echo $u['cedula'];?></td>
                        <td><?php echo $u['cargo'];?></td>
                        <td><?php echo $u['fecha_ingreso'];?></td>
                        <td><?php echo $u['servicio'];?></td>
                        <td><?php echo $u['campana'];?></td>
                        <td><?php echo $u['rotacion'];?></td>
                        <td><?php echo $u['turno'];?></td>
                        <td>
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-2"></div>

                              <div class="col-3" >
                                <a title="Editar Datos" href="?view=usuarios&mode=edituser&id=<?php echo $u['id_datos_empleados'];?>" name="edituser" id="edituser" class="btn btn-sm btn-warning"><span class="icon text-white-100"><i class="fas fa-fw fa-pen"></i></span></a>
                              </div>
                             

                              <div class="col-3" <?php if ( $_SESSION['cargo'] == 'ADMINISTRADOR'|| $_SESSION['cargo'] == 'COORDINADOR' || $_SESSION['cargo'] == 'GERENTE') { echo 'style = "display:block;" '; } else{  echo 'style = "display:none;" ';}?> > <!-- style="padding-left: 8px;padding-right: 15px;" -->

                                <button title="Reinicio De Clave" onclick="button_modalUpdatePasswor(<?=$u['id_datos_empleados']?>)" type="submit" class="ml-1 btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#modalUpdatePasswordUser"><span class="icon text-white-100"><i class="fas fa-sync-alt"></i></span></button>
                              </div>
                              
                              
                              <div class="col-3" >
                                <button title="Eliminar Usuario" onclick="button_modalDelete(<?=$u['id_datos_empleados']?>)" type="submit" class="ml-1 btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#modalDeleteuser"><span class="icon text-white-100"><i class="fas fa-flag"></i></span></button>
                              </div>

                              <div class="col-1"></div>
                            </div>
                          </div>
                        </td>
                      </tr>
                        <?php }?>
                    </tbody>
                  </table>              
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- MODAL 1 -->
  <div class="modal fade" id="modalDeleteuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desincorporación de personal</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col form-group">
                    <span class="col">Motivo de egreso</span>
                    <select class="selectpicker show-menu-arrow show-tick form-control" name="razonDelete" id="razonDelete" required>
                        <option value="" disabled selected style="display:none;">Seleccione...</option>
                        <option value="ABANDONO">ABANDONO</option>
                        <option value="FINALIZACIÓN DE PRIMER CONTRATO">FINALIZACIÓN DE PRIMER CONTRATO</option>
                        <option value="FINALIZACIÓN DE SEGUNDO CONTRATO">FINALIZACIÓN DE SEGUNDO CONTRATO</option>
                        <option value="RENUNCIA">RENUNCIA</option>
                    </select>
                    <input type="text" hidden  name="id_datos_empleadosDelete" id="id_datos_empleadosDelete">
                    <input type="text" hidden  name="nombreUser" id="nombreUser">
                    <input type="text" hidden  name="apellidoUser" id="apellidoUser">
                    <input type="text" hidden  name="nombreApelliUser" id="nombreApelliUser">
                    <input type="text" hidden  name="cargoUser" id="cargoUser">
                </div>
                <div class="col form-group">
                    <span class="col">Observaciones</span>
                    <textarea class="form-control" rows=3 maxlength="250" name="observacionesDelete" id="observacionesDelete" onkeyup="mayus(this);" required></textarea>
                </div>

                <div class="form-group row center-block" id="bloqueCambioSupervDelete"  style="display: none; background-color: #7ac1f6; padding: 15px; border-radius: 15px; color: black; font-weight: 500;">
                    <div class="col-sm-6">
                      <label for="superviEditActualDelete" class="visually-hidden">Supervisor Actual</label>
                      <input type="text" readonly class="form-control " id="superviEditActualDelete" value="">
                    </div>
                    <div class="col-sm-6">
                      <label for="inputPassword2" class="visually-hidden">Supervisor Nuevo</label>
                      <select  class="form-control" id="supervisorEditNuevoDelete" name="supervisorEditNuevoDelete" onchange="cambioSuperviEdit(this.value);">
                          <option value="0">Seleccione...</option> 
                          <?php foreach($listSupervisor as $listS) {?>
                            <option value="<?=$listS['id_datos_empleados']?>"><?=$listS['apellido'].' '.$listS['nombre'].' ('.$listS['servicio'].')'?></option>
                          <?php } ?>
                      </select> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Descartar</button>
                <button class="btn btn-primary" type="button" id="btn-DeleteUser">Guardar</button>
            </div>
        </div>
    </div>
  </div>

  <!-- MODAL 2 -->
  <div class="modal fade" id="modalUpdatePasswordUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reinicio de clave</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="col">Esta seguro de reiniciar la clave de <input type="text" style="border: none;" name="nombreApelliUser_passw" id="nombreApelliUser_passw">?</span>

                    <input type="text" hidden  name="id_datos_empleadosDelete_passw" id="id_datos_empleadosDelete_passw">
                    <input type="text" hidden  name="nombreUser_passw" id="nombreUser_passw">
                    <input type="text" hidden  name="apellidoUser_passw" id="apellidoUser_passw">
                    <input type="text" hidden  name="nombreApelliUser_passw" id="nombreApelliUser_passw">
                    <input type="text" hidden  name="cargoUser_passw" id="cargoUser_passw">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">NO</button>
                <button class="btn btn-primary" type="button" id="btn-UpdatePasswordUser">SI</button>
            </div>
        </div>
    </div>
  </div>
<script src="public/js/register.js"></script>




