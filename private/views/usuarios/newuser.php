<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold text-dark">CARGA INDIVIDUAL</h6>
              </div>
              <div class="card-body">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".js-example-basic-multiple-limit").select2({
                          maximumSelectionLength: 3
                        });
                    });

                    var conSuma = 1;
                    var conRest = 0;
                    var con = 0;

                    function agregarServiCampanasNew(){
                        conSuma++;
                        $('#agregarBloque').val(conSuma);

                          $('#bloqueeServCampMas').append('<div id="bloqueeServCampMas'+con+'"><div class="form-group row offset-md-2" ><div class="col-md-5"><label for="inputEmail4" class="form-label">Servicio</label><select  required class="form-control servMuch" name="servicio_indexM" id="servicio_indexM[]" onchange="selectOnchangeServV(this.value)"><option value="" selected style="display:none;">Seleccione...</option><?php foreach ($servicios as $s) { ?><option value="'+con+'?/?<?php echo $s['idServicio']."?/?".$s['servicios'];?>"> <?php echo $s['servicios'];?></option><?php }?></select></div><div class="col-md-5"><label for="inputPassword4" class="form-label">Campaña</label><div id="bloqueCampanaM'+con+'"></div></div><div class="col-md-1"><a style="margin-top: 33px;" title="Quitar campañas" id="quitaragregarServiCampanasNew" class="btn btn-success btn-sm" onclick="quitaragregarServiCampanasNew('+con+')" type="button"><span class="fa fa-minus" style="margin-top: 10px;"></span></a></div></div></div>')
                          con++

                        if ( conSuma == 3) {
                          $('#agregar_camapna').hide();
                        }else{
                          $('#agregar_camapna').show();
                        }

                    } //class="form-inline"
                            
                    function quitaragregarServiCampanasNew(hola){  
                       // alert(hola)
                        conSuma--;
                        $('#agregarBloque').val(conSuma);
                        $('#bloqueeServCampMas'+hola).remove()
                        
                        if ( conSuma == 3) {
                          $('#agregar_camapna').hide();
                        }else{
                          $('#agregar_camapna').show();
                        }
                    }

                    function mayus(e) {
                      e.value = e.value.toUpperCase();
                    }   
              </script>

              


                <form role="form" name="f_newuser" id="f_newuser" autocomplete="off">

                    <div class="form-group row">
                      <label for="nombre_index" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                      <div class="col-sm-10">
                       <input type="text" id="nombre_index" class="form-control col-form-label-sm" required placeholder="Juan" name="nombre_index" maxlength="55" onkeyup="mayus(this);">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="apellido_index" class="col-sm-2 col-form-label col-form-label-sm">Apellido</label>
                      <div class="col-sm-10">
                        <input type="text" id="apellido_index" class="form-control col-form-label-sm" placeholder="Gomez" name="apellido_index" onkeyup="mayus(this);" maxlength="55" required />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="cedula_index" class="col-sm-2 col-form-label col-form-label-sm">Cédula</label>
                      <div class="col-sm-10">
                        <input onkeyup="myFunctionCedula(this.value)" type="number" id="cedula_index" class="form-control col-form-label-sm" placeholder="2526984" name="cedula_index" required />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="genero" class="col-sm-2 col-form-label col-form-label-sm">Género</label>
                      <div class="col-sm-10">
                        <select class="form-control col-form-label-sm" name="genero_index" required id="genero_index">
                        <option disabled selected style="display:none;">Género...</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="cargo_index" class="col-sm-2 col-form-label col-form-label-sm">Cargo</label>
                      <div class="col-sm-10">
                        <select class="form-control col-form-label-sm" name="cargo_index" id="cargo_index" required onchange="selectCargo(this.value)">
                          <option value="" disabled selected style="display:none;">Seleccione...</option>
                          <?php foreach($cargos as $listC) {?>                            
                              <option value="<?=$listC['cargos']?>"><?=$listC['cargos']?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="fecha_ingreso_index" class="col-sm-2 col-form-label-sm">Fecha ingreso</label>
                      <div class="col-sm-10">
                        <input type="date" id="fecha_ingreso_index" class="form-control col-form-label-sm" placeholder="Fecha de ingreso..." name="fecha_ingreso_index" maxlength="55" required />
                      </div>
                    </div> 

                    <div class="form-group row offset-md-4" id="bloque_cheboxServicio" style="display:none;">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioServ" id="variosServiceU" value="cheboxS1" onclick="cheboxServe(this.value)">
                        <label class="form-check-label" for="variosServiceU">Un servicio</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radioServ" id="variosServiceM" value="cheboxS2" onclick="cheboxServe(this.value)">
                        <label class="form-check-label" for="variosServiceM">Varios servicios</label>
                      </div>
                    </div> 


                    <input type="text" id="resultSelectRadio" hidden class="form-control col-form-label-sm" name="resultSelectRadio"> <!-- VALOR SI ES VARIOSSS O UNOOO -->

                    <input type="text" id="agregarBloque" readonly hidden  class="form-control col-form-label-sm col-md-3" name="agregarBloque_"> 

                    <div id="cuadroVariosServicios" style="display:none;" >
                      <a style="float:right;" id="agregar_camapna" onclick="agregarServiCampanasNew();" class="btn btn-success btn-sm" type="button"><span class="fa fa-plus"></span></a>
                      <div id="bloqueeServCampMas">
                        <div class="form-group row offset-md-2">
                          <div class="col-md-5">
                            <label for="inputEmail4" class="form-label">Servicio</label>
                            <select disabled required class="form-control servMuch" name="servicio_indexM" id="servicio_indexM[]" onchange="selectOnchangeServV(this.value)">
                              <option value="" disabled selected style="display:none;">Seleccione...</option>
                              <?php foreach ($servicios as $s) { ?>
                                <option value='?/?<?= $s['idServicio']."?/?".$s['servicios']?>'> <?= $s['servicios'] ?></option>
                              <?php }?>                         
                            </select>
                          </div>
                                         
                          <div class="col-md-5">
                            <label for="inputPassword4" class="form-label">Campaña</label>
                            <div  id="bloqueCampanaM"></div>
                          </div>
                        </div>
                      </div>
                    </div>
 

                    





                    <div id="cuadroUnServicios" style="display:none;">                     
                      <!-- ____BLOQUE 1 SERVICIO____ -->
                      <div class="form-group row" id="div_bloqueServicio">
                        <label for="servicio_index" class="col-sm-2 col-form-label-sm">Servicio</label>
                        <div class="col-sm-10" id="block_servicio">
                          <select disabled required class="form-control" name="servicio_index" id="servicio_index" onchange="selectOnchange(this.value)">
                            <option value="" disabled selected style="display:none;">Seleccione...</option>
                            <?php foreach ($servicios as $s) { ?>
                              <option value='<?= $s['idServicio']."?/?".$s['servicios']?>'> <?= $s['servicios'] ?></option>
                            <?php }?>                         
                          </select>
                          <input type="text" id="name_servicio" hidden class="form-control col-form-label-sm" name="name_servicio"/>
                        </div>
                      </div>
                      <!-- ______________BLOQUE 1 Campana____________________ -->
                      <div class="form-group row" id="div_bloqueCampana">
                        <label for="rol" class="col-sm-2 col-form-label-sm">Campaña Principal</label>
                        <div class="col-sm-10" id="bloqueCampana"></div>
                      </div>
                    </div>











                    













 


                    <br>
                    <div class="form-group row">
                      <label for="rotacion_index" class="col-sm-2 col-form-label-sm">Rotación</label>
                      <div class="col-sm-10">
                        <select required class="form-control col-form-label-sm" name="rotacion_index" id="rotacion_index">
                          <option value="" disabled selected style="display:none;">Seleccione...</option>
                          <option value="SAB - MIE">SAB - MIE</option>
                          <option value="MAR - SAB">MAR - SAB</option>
                          <option value="DOM - JUE">DOM - JUE</option>                          
                          <option value="LUN - VIER">LUN - VIER</option>
                          <option value="VIER - MAR">VIER - MAR</option>
                        </select>
                      </div>
                    </div>
 
                    <div class="form-group row">
                      <label for="turno_index" class="col-sm-2 col-form-label-sm">Turno</label>
                      <div class="col-sm-10">
                        <select required class="form-control col-form-label-sm" name="turno_index" id="turno_index">
                          <option value="" disabled selected style="display:none;">Seleccione...</option>
                          <option value="Full-Time"> Full-Time </option>
                          <option value="Diurno"> Diurno </option>
                          <option value="Mixto"> Mixto </option>
                          <option value="Nocturno"> Nocturno </option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row" id="bloqueSuperv">
                      <label for="supervisor_index" class="col-sm-2 col-form-label-sm">Supervisor</label>
                      <div class="col-sm-10" id="bloqueSupervisor"></div>

                      <!--
                      <div class="col-sm-10">
                        <select class="form-control" id="supervisor_index" name="supervisor_index" required>
                          <option value="" disabled selected style="display:none;">Seleccione...</option>
                          <?php foreach($listSupervisor as $listS) {?>                            
                              <option value="<?=$listS['id_datos_empleados']?>"><?=$listS['nombre']. ' '.$listS['apellido'].' ('.$listS['servicio'].')'?></option>
                          <?php }?>
                        </select>
                      </div>
                    -->
                    </div>


                    <div class="form-group row">
                      <label for="usernewIndex" class="col-sm-2 col-form-label col-form-label-sm">Usuario</label>
                      <div class="col-sm-10">
                        <input type="text" id="usernewIndex" class="form-control col-form-label-sm" placeholder="" name="usernewIndex" maxlength="20" readonly required />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="pass_index" class="col-sm-2 col-form-label col-form-label-sm">Clave</label>
                      <div class="col-sm-10">
                        <input type="text" id="pass_index" readonly value="timer12345++" class="form-control col-form-label-sm" placeholder="" name="pass_index" required />
                      </div>
                    </div>


                    <input id="btn-register" name="btn-register" type="button" class="btn btn-md btn-success" value="Guardar" />

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="public/js/register.js"></script>