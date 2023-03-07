<script type="text/javascript" src="public/js/config.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary text-dark">
      <h6 class="m-0 font-weight-bold">POSICIONES MES</h6>
    </div> 
    <div class="card-body">
      <script type="text/javascript">
        $(document).ready(function(){
          $('#tableDosposicion').DataTable();
        });
      </script>
      <!-- _____________________________________________________________________________________________________________________________ -->
      <form name="resultados" method="POST" action="?view=config&mode=registro_posiciones" id="form_posiciones_" > <!-- onsubmit="return form_posiciones(false);" -->
        <div class="form-row"> 
          <div class="form-group col-lg-2">  
            <label>Cantidad posición</label>
            <input type="number" min="1" pattern="^[0-9]+" required  id="cant_posicion_" name="cant_posicion_" class="form-control">
          </div>
          <div class="form-group col-lg-3">  
            <label for="servicio_" class="form-label">Servicio</label>
            <?php if ( $_SESSION['cargo'] == 'ADMINISTRADOR') { ?>
              <select class="form-control" id="servicio_posicion_" name="servicio_posicion_" required> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                <?php 
                foreach($consulta2 as $s) {?>
                    <option  value="<?= $s['idServicio']."?/?".$s['servicios']?>"><?=$s['servicios']?></option>
                <?php } ?>
              </select>

            <?php }else{?>
               <select disabled class="form-control" id="servicio_posicion_" name="servicio_posicion_" required> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                <?php 
                foreach($consulta2 as $s) {?>
                    <option  value="<?= $s['idServicio']."?/?".$s['servicios']?>"><?=$s['servicios']?></option>
                <?php } ?>
              </select>
            <?php } ?>
          </div>
          <!-- <div class="form-group col-lg-3">  
            <label for="" class="form-label">Campaña</label>
            <div class="" id="bloqueCampanaPosici"> <select disabled class="form-control"></select> </div>
          </div> -->
          <div class="form-group col-lg-2">  
            <label>Mes</label>
            <input type="text" readonly class="form-control" value="<?=date('m')?>" name="mes_" id="mes_" autofocus/>
          </div>
          <div class="form-group col-lg-2">  
            <label>Año</label>
            <input type="text" readonly class="form-control" value="<?=date('Y')?>" name="anio_" id="anio_" autofocus/>
          </div>
          
        </div>

        <div class="form-group col-lg-3">
          <button  class="btn btn-success" id="btn-ingresarPosiciones" >Registrar</button> 
        </div>
      </form>
      <!-- _____________________________________________________________________________________________________________________________ -->
      <!-- _____________________________________________________________________________________________________________________________ -->
      <br><br>
      <div class="card-body" style= "background-color: #adbdea4f;">
        <input style="display:none;" type="text" name="valor_PosicionMes" id="valor_PosicionMes_">
        <table style= ""  class="table table-hover" id="tableDosposicion" cellspacing="0">
          <thead>
            <tr>
              <th>ID TABLA</th>
              <th>CANTIDAD POSICIÓN</th>
              <th>SERVICIO</th>
              <th>MES</th>
              <th>AÑO</th>  
              <th>FECHA REGISTRO</th>   
              <th>ACCIÓN</th>     
            </tr>
          </thead>
          <tbody>
            <?php 
              if ($consulta3) {
                for ($i=0; $i < count($consulta3) ; $i++) {?>
              <tr>
                <td><?= $consulta3[$i]['idPM'] ?></td>
                <td><?= $consulta3[$i]['posicion_'] ?></td>
                <td><?= $consulta3[$i]['servicio_'] ?></td>
                <td><?= $consulta3[$i]['mes_'] ?></td>
                <td><?= $consulta3[$i]['year_'] ?></td>
                <td><?= $consulta3[$i]['fecha_registro_'] ?></td>
                <td>
                  <button data-toggle="modal" data-target="#modalEditPM" title="Editar" style="color: white;" onclick="editarPosicionMes(this.value);" id="editPosicionMes" class="btn btn-sm btn-warning" value="<?=$consulta3[$i]['idPM']?>"><i class="fas fa-fw fa-pen"></i></button>

                  <button data-toggle="modal" data-target="#modalDeletePM" title="Borrar" style="color: white;" onclick="deleteePosicionMes(this.value);" id="deletePosicionMes" class="btn btn-sm btn-danger" value="<?=$consulta3[$i]['idPM']?>"><i class="fa fa-times"></i></button>

                </td>
                <!-- href="?view=config&mode=editPosicion&idPosicionMes=<?php echo $consulta3[$i]['idPM'];?>" -->
              </tr>
            <?php } }else{} ?>
          </tbody>
        </table>
      </div>
      <!-- _____________________________________________________________________________________________________________________________ -->
      <!-- _____________________________________________________________________________________________________________________________ -->
    </div>
  </div>
</div>





        <div class="modal fade" tabindex="-1" role="dialog" id="modalEditPM" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Posición a editar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-row"> 
                      <input style="display:none;" type="text" name="valorPosicionMes" id="valorPosicionMes_">

                      <div class="form-group col-lg-4">  
                        <label>Cantidad posición</label>
                        <input type="number" min="1" pattern="^[0-9]+" required  id="cant_posicionEdit_" name="cant_posicion_" class="form-control">
                      </div>
                      <div class="form-group col-lg-3">  
                        <label for="servicio_" class="form-label">Servicio</label>
                        <input type="text"  readonly  id="servicioEdit_" name="servicio_" class="form-control">
                      </div>
                      <div class="form-group col-lg-2">  
                        <label>Mes</label>
                        <input type="text" readonly class="form-control" value="" name="mes_" id="mesEdit_" autofocus/>
                      </div>
                      <div class="form-group col-lg-2">  
                        <label>Año</label>
                        <input type="text" readonly class="form-control" value="<" name="anio_" id="anioEdit_" autofocus/>
                      </div>  
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoEditPM()" data-dismiss="modal">CANCELAR</button>
                <button type="button" class="btn btn-danger" onclick="SiEditPM()">GUARDAR</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalDeletePM" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Posición a eliminar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <center><h6> ¿Está seguro de eliminar la posiciónde dicho servicio? </h6></center>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoBorrarPM()" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" onclick="SiBorrarPM()">SI</button>
              </div>
            </div>
          </div>
        </div>