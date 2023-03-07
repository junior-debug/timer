<script type="text/javascript" src="public/js/agregar.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary text-dark">
      <h6 class="m-0 font-weight-bold">NUEVO SERVICIO Y CAMPAÑA</h6>
    </div>
    <div class="card-body">
      <script type="text/javascript">
        $(document).ready(function(){
            $('#tableDosposicion').DataTable({
                 "order": [[ 0, "desc" ]]
            });
        });
        $(document).ready(function(){
            $('#tableDosposicion_').DataTable({
                 "order": [[ 0, "desc" ]]
            });
        });
      </script>
        <a href="?view=agregar&mode=historicoServCampa"> <button data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="btn btn-warning" id="volver" style="float:right">Histórico</button></a><br><br>

        <?php 
           // $resultado = base64_decode($_GET['resultado']);
           // $resultado1 = base64_decode($_GET['resultado1']);

            if (isset( $_GET['resultado'] ) == 1 ) {
                echo '  <center><div class="container alert alert-success" role="alert" style="text-align:center; color:#498849; font-size:15px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <label><h5>Carga exitosa</h5></label><br>
                            <strong>Duplicados: '. $_GET['resultado1']. ' </strong><br>
                        </div></center>';
                    
                         
            }else{}
        ?>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="true">Servicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="campana-tab" data-toggle="tab" href="#campana" role="tab" aria-controls="campana" aria-selected="false">Campaña</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                <br> 
                <form id="formAgregarServicios" action="?view=agregar&mode=guardar_servicios" method="post">
                    <input type="text" id="valorServicioId" name="" class="form-control" style="display:none;">
                    <div class="row">
                        <div class="col-sm-12">
                            <a id="agregar_service" onclick="agregarServicios();" class="btn btn-success btn-sm" type="button"><span class="fa fa-plus"></span></a>
                            <div id="bloque_service">    
                                <div class="form-group row center-block">
                                    <div class="col-sm-3">
                                        <label>Servicio</label>
                                    </div>
                                    <div class="col-sm-9"></div>
                                    <div class="col-sm-3">
                                        <input type="text"  required  id="name_servicioAgregar" name="name_servicioAgre[]" class="form-control" onkeyup="mayus(this);">
                                    </div>
                                </div>
                            </div>
                            <button  class="btn btn-primary" id="button_servicio" >Guardar</button><!-- data-dismiss="modal" -->
                        </div>              
                    </div> 
                </form>                
                <br><br>
                <hr style=" height: 1px;  background-color: #00be00;">
                <div class="card-body" style= "background-color: #defff3;">
                    <table style= ""  class="table table-hover" id="tableDosposicion" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID TABLA</th>
                          <th>SERVICIO</th>  
                          <th>ACCIÓN</th>     
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if ($servicios_b2) {
                            for ($i=0; $i < count($servicios_b2) ; $i++) {?>
                          <tr>
                            <td><?= $servicios_b2[$i]['idServicio'] ?></td>
                            <td><?= $servicios_b2[$i]['servicios'] ?></td>
                            <td>
                                <button style="color: white;" onclick="editarServicioTabla(this.value);" id="editService" class="btn btn-sm btn-warning" value="<?=$servicios_b2[$i]['idServicio']?>"><i class="fas fa-fw fa-pen"></i></button>

                                <button data-toggle="modal" data-target="#modalService" style="color: white;" onclick="ModalServicioTabla(this.value);" id="deletService" class="btn btn-sm btn-danger" value="<?=$servicios_b2[$i]['idServicio']?>"><i class="fa fa-times"></i></button>
                            </td>
                          </tr>
                        <?php } }else{} ?>
                      </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade " id="campana" role="tabpanel" aria-labelledby="campana-tab"><br>
                    <form id="formAgregarCampanas" action="?view=agregar&mode=guardar_campanas" method="post">
                        <input type="text" id="valorCampanaId" name="" class="form-control" style="display:none;">
                        <div class="form-row"> 
                            <div class="form-group col-sm-3">  
                            <label>Servicio</label>
                                <select required class="form-control col-form-label-sm" name="servicio_campana" id="servicio_campana" onchange="selectOnchangeService(this.value)">
                                    <option value="" disabled selected style="display:none;">Seleccione...</option>
                                    <?php foreach ($servicios_b2 as $s) { ?>
                                    <option value='<?= $s['idServicio']."?/?".$s['servicios']?>'> <?= $s['servicios'] ?></option>
                                    <?php }?>                         
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <a id="agregar_camapna" onclick="agregarCampañas();" class="btn btn-success btn-sm" type="button"><span class="fa fa-plus"></span></a>
                                <div id="bloque_campanas">    
                                    <div class="form-group row center-block">
                                        <div class="col-sm-3">
                                            <label>Campaña</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Abreviación</label>
                                        </div>
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-3">
                                            <input type="text"  required  id="name_campanaAgregar" name="name_campanaAgre[]" class="form-control" onkeyup="mayus(this);">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text"  required  id="abrev_campanaAgregar" name="abrev_campanaAgre[]" class="form-control" onkeyup="mayus(this);">
                                        </div>
                                    </div>
                                </div>
                                <button  class="btn btn-primary" id="button_campana" onclick="guardarCampana();">Guardar</button>
                            </div>              
                        </div>
                    </form>
                        <br><br>
                        <hr style=" height: 1px;  background-color: #00be00;">
                        <div class="card-body" style= "background-color: #defff3;">
                            <table style= ""  class="table table-hover" id="tableDosposicion_" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>ID TABLA</th>
                                  <th>SERVICIO</th>
                                  <th>CAMPAÑA</th> 
                                  <th>ABREVIACIÓN</th>  
                                  <th>ACCIÓN</th>     
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                  if ($servicios_campana_b2) {
                                    for ($i=0; $i < count($servicios_campana_b2) ; $i++) {?>
                                  <tr>
                                    <td><?= $servicios_campana_b2[$i]['id_campana'] ?></td>
                                    <td><?= $servicios_campana_b2[$i]['servicios'] ?></td>
                                    <td><?= $servicios_campana_b2[$i]['name_campana'] ?></td>
                                    <td><?= $servicios_campana_b2[$i]['abrev_campana'] ?></td>
                                    <td>
                                        <button style="color: white;" onclick="editarCampanass(this.value);" id="edit_servi_campanas" class="btn btn-sm btn-warning" value="<?=$servicios_campana_b2[$i]['id_campana']?>"><i class="fas fa-fw fa-pen"></i></button>

                                        <button data-toggle="modal" data-target="#modalCampana" style="color: white;" onclick="ModalCampanaTabla(this.value);" id="deletService" class="btn btn-sm btn-danger" value="<?=$servicios_campana_b2[$i]['id_campana']?>"><i class="fa fa-times"></i></button>
                                    </td>
                                    <!-- href="?view=config&mode=editPosicion&idPosicionMes=<?php echo $servicios_campana_b2[$i]['id_campana'];?>" -->
                                  </tr>
                                <?php } }else{} ?>
                              </tbody>
                            </table>
                        </div>
                    
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="modalService" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Servicio a eliminar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6> ¿Está seguro de eliminar el servicio? </h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoBorrarServicioTabla()" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" onclick="SiBorrarServicioTabla()">SI</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalCampana" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Campaña a eliminar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6> ¿Está seguro de eliminar la campaña? </h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoBorrarCampanaTabla()" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" onclick="SiBorrarCampanaTabla()">SI</button>
              </div>
            </div>
          </div>
        </div>
        
      <!-- _____________________________________________________________________________________________________________________________ -->
      <!-- _____________________________________________________________________________________________________________________________ -->
    </div>
  </div>
</div>

