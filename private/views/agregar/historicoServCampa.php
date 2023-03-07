<script type="text/javascript" src="public/js/agregar.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary text-dark">
      <h6 class="m-0 font-weight-bold">HISTORICO DE SERVICIO Y CAMPAÑA</h6>
    </div>
    <div class="card-body">
      <script type="text/javascript">
        $(document).ready(function(){
            $('#tableDosposicion').DataTable({
                 "order": [[ 0, "desc" ]]
            });
        });
      </script>
        <a href="?view=agregar&mode=index_"> <button data-toggle="tooltip" data-placement="top" title="" data-original-title="" class="btn btn-warning" id="volver" style="float:right">Volver</button></a>

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
                <div class="card-body" style= "background-color: #defff3;">
                    <input type="text" id="valorServicioIdHist" name="" class="form-control" style="display:none;">
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
                          if ($hist_servicios_b2) {
                            for ($i=0; $i < count($hist_servicios_b2) ; $i++) {?>
                          <tr>
                            <td><?= $hist_servicios_b2[$i]['idServicio'] ?></td>
                            <td><?= $hist_servicios_b2[$i]['servicios'] ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#modalServiceHist" style="color: white;" onclick="ModalServicioTablaHist(this.value);" id="deletService" class="btn btn-sm btn-success" value="<?=$hist_servicios_b2[$i]['idServicio']?>"><i class="fa fa-check"></i></button>
                            </td>
                          </tr>
                        <?php } }else{} ?>
                      </tbody>
                    </table>
                </div>
            </div>
            <!-- __________________________________________________________________________________________________________________________ -->
            <div class="tab-pane fade " id="campana" role="tabpanel" aria-labelledby="campana-tab"><br>
                <div class="card-body" style= "background-color: #defff3;">
                    <input type="text" id="valorCampanaIdHist" name="" class="form-control" style="display:block;">
                    <table style= ""  class="table table-hover" id="tableDosposicion" cellspacing="0">
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
                        if ($hist_servicios_campana_b2) {
                            for ($i=0; $i < count($hist_servicios_campana_b2) ; $i++) {?>
                                <tr>
                                    <td><?= $hist_servicios_campana_b2[$i]['id_campana'] ?></td>
                                    <td><?= $hist_servicios_campana_b2[$i]['servicios'] ?></td>
                                    <td><?= $hist_servicios_campana_b2[$i]['name_campana'] ?></td>
                                    <td><?= $hist_servicios_campana_b2[$i]['abrev_campana'] ?></td>
                                    <td>
                                        <button data-toggle="modal" data-target="#modalCampanaHist" style="color: white;" onclick="ModalCampanaTablaHist(this.value);" id="deletService" class="btn btn-sm btn-success" value="<?=$hist_servicios_campana_b2[$i]['id_campana']?>"><i class="fa fa-check"></i></button>
                                    </td>
                                </tr>
                    <?php   } 
                        }else{} ?>
                        </tbody>
                    </table>
                </div>                    
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="modalServiceHist" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Servicio a activar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6> ¿Está seguro de activar el servicio? </h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoBorrarServicioTablaHist()" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" onclick="SiBorrarServicioTablaHist()">SI</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modalCampanaHist" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="">Campaña a activar.</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h6> ¿Está seguro de activar la campaña? </h6>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="NoBorrarCampanaTablaHist()" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" onclick="SiBorrarCampanaTablaHist()">SI</button>
              </div>
            </div>
          </div>
        </div>
        
      <!-- _____________________________________________________________________________________________________________________________ -->
      <!-- _____________________________________________________________________________________________________________________________ -->
    </div>
  </div>
</div>

