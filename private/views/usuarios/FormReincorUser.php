<div class="container-fluid">
  <div class="row">
    <div class="col-2"></div>
      <div class="col-lg-6">
        <div class="panel panel-default ">
          <div class="panel-body">
            <div class="form-group">
              <div class="card shadow mb-4">
                <div class="card-header py-3 border-bottom-primary">
                  <h6 class="m-0 font-weight-bold text-dark">REACTIVACIÓN DEL USUARIO</h6>
                </div>
                <div class="card-body">
                  <h2><span class="form-group-addon">Datos del usuario</span></h2><h4><strong><v class="text-primary"><?=$apellido.' '.$nombre?></v></strong></h4>

                  <div class="form-group">
                    <span class="form-group-addon">Nombre</span>
                    <input type="text" readonly class="form-control" onkeyup="mayus(this);" aria-describedby="nombre" required name="nombreEdit" id="nombreEdit" value="<?=$nombre?>"/>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Apellido</span>
                    <input type="text" readonly class="form-control" onkeyup="mayus(this);" aria-describedby="apellido" required  name="apellidoEdit" id="apellidoEdit" value="<?=$apellido?>" />
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Cédula</span>
                    <input type="number" readonly class="form-control" aria-describedby="cedula" required  name="cedulaEdit" id="cedulaEdit" value="<?=$cedula?>" />
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Genero</span>
                    <select class="form-control col-form-label-sm" name="genero_edit" required id="genero_edit">
                        <option disabled selected style="display:none;">Género...</option>
                        <?php 
                        if ($genero == 'F') {?>
                          <option selected value="F">Femenino</option>
                          <option value="M">Masculino</option>

                        <?php }else{ ?>
                          <option  value="F">Femenino</option>
                          <option selected value="M">Masculino</option>
                        <?php } ?>
                        
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Cargo</span>
                    <select class="form-control" id="cargoEdit" name="cargoEdit" required onchange="selectCargoEdit(this.value);">
                        <?php foreach($consulta1 as $u) {
                          if ($u['cargos'] == strtoupper($cargo)){?>
                            <option selected value="<?=$u['cargos']?>"><?=$u['cargos']?></option>
                        <?php }else{ ?>
                            <option value="<?=$u['cargos']?>"><?=$u['cargos']?></option>
                        <?php } }?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Fecha ingreso</span>
                    <input style="border-color: red;" type="date" class="form-control" aria-describedby="fecha_ingreso" required  name="fechaIngreEdit" id="fechaIngreEdit" value="<?=$fecha_ingreso?>" />
                  </div>
                  
                  <div class="form-group">
                    <span class="form-group-addon">Servicio</span> <!-- nombreSelectCampaña ==> campana_index -->
                    <select class="form-control" id="servicioEdit" name="servicioEdit" required onchange="selectOnchangeEdit_(this.value)">
                        <?php foreach($consulta2 as $s) {
                          if ($s['servicios'] == strtoupper($servicio)){?>
                            <option selected value="<?= $s['idServicio']."?/?".$s['servicios']?>"><?=$s['servicios']?></option>
                        <?php }else{ ?>
                            <option value="<?= $s['idServicio']."?/?".$s['servicios']?>"><?=$s['servicios']?></option>
                        <?php } }?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Campaña Principal</span> 

                    <select class="form-control" id="campanaEdit" name="campanaEdit" required>
                        <?php foreach($consulta5 as $cm) {
                          if ($cm['abrev_campana'] == strtoupper($campana)){?>
                            <option selected value="<?= $cm['abrev_campana']?>"><?=$cm['name_campana']?></option>
                        <?php }else{ ?>
                            <option value="<?= $cm['abrev_campana']?>"><?=$cm['name_campana']?></option>
                        <?php } }?>
                    </select>

                    <div class="" id="bloqueCampana">
                        
                    </div>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Rotacion</span>
                    <select class="form-control" id="rotacionEdit" name="rotacionEdit" required>
                        <?php foreach($consulta3 as $r) {
                          if ($r['rotacions'] == strtoupper($rotacion)){?>
                            <option selected value="<?=$r['rotacions']?>"><?=$r['rotacions']?></option>
                        <?php }else{ ?>
                            <option value="<?=$r['rotacions']?>"><?=$r['rotacions']?></option>
                        <?php } }?>
                    </select>
                  </div>

                  <div class="form-group">
                    <span class="form-group-addon">Turno</span>
                    <select class="form-control" id="turnoEdit" name="turnoEdit" required>
                        <?php foreach($consulta4 as $t) {
                          if ($t['turnos'] == strtoupper($turno)){?>
                            <option selected value="<?=$t['turnos']?>"><?=$t['turnos']?></option>
                        <?php }else{ ?>
                            <option value="<?=$t['turnos']?>"><?=$t['turnos']?></option>
                        <?php } }?>
                    </select>
                  </div>

                  <div id="bloqueSupervReincor">
                    <div class="form-group">
                      <span class="form-group-addon">Supervisor</span>
                        <select <?php if (strtoupper($cargo) == 'SUPERVISOR' || strtoupper($cargo) == 'ANALISTA'){ echo 'disabled';}?> class="form-control" id="supervisorEdit" name="supervisorEdit" required>
                          <option value="" selected >Seleccione...</option>
                          <?php foreach($listSuperv as $listS) {
                            //echo $listS['id_datos_empleados'].' == '.$IDsupervidor;
                            if ($listS['id_datos_empleados'] == $IDsupervidor){?>
                              <option selected value="<?=$listS['id_datos_empleados']?>"><?=$listS['apellido'].' '.$listS['nombre']?></option>
                          <?php }else{ ?>
                              <option value="<?=$listS['id_datos_empleados']?>"><?=$listS['apellido'].' '.$listS['nombre']?></option>
                          <?php } }?>
                        </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="usernewEdit" class=" col-form-label col-form-label-sm">Usuario</label>
                    <input type="text" readonly class="form-control" aria-describedby="users" required  name="usersEdit" id="usersEdit" value="<?=$users?>" />
                  </div>
                  <div class="form-group">
                    <label for="pass_Edit" class=" col-form-label col-form-label-sm">Clave</label>
                    <input type="text" readonly class="form-control" aria-describedby="pass" required  name="passwords" id="passwords" value="timer12345++"/>
                  </div>

                  <input type="hidden" id="id_datos_empleadosEdit" value="<?=$id_datos_empleados?>">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-3">
                        <input type="button" class="btn btn-large btn-primary" aria-describedby="updateEditReincorpo" id="updateEditReincorpo" value="Reincorporar"/>
                      </div> 
                    </div>
                  </div>
                  <!--<div class="form-group">
                    <div class="form-row">
                      <div class="col">
                        <a href="?view=usuarios&mode=index" class="btn btn-medium btn-dark">Volver</a>
                      </div>
                    </div>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script src="public/js/register.js"></script>