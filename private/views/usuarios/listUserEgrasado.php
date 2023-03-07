<div class="container">
  <div class="row">
    <div class="col">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold text-dark">HISTÓRICO DE EGRESADOS</h6><br>
                <a style="color:#0bac1c;" href="?view=usuarios&mode=descargaReporteEgresado">
                  <font >Descarga de egresados </font>
                </a>
              </div>
              <div class="card-body"><br>
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Cargo</th>
                        <th>Servicio</th>
                        <th>Rotación</th>
                        <th>Turno</th>
                        <th>Motivo</th>
                        <th>Observaciones</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($listUserEgrasado as $u) {?>
                        <td><?php echo $u['id_datos_empleados'];?></td>
                        <td><?php echo $u['apellido'].' '.$u['nombre'];?></td>
                        <td><?php echo $u['cedula'];?></td>
                        <td><?php echo $u['cargo'];?></td>
                        <td><?php echo $u['servicio'];?></td>
                        <td><?php echo $u['rotacion'];?></td>
                        <td><?php echo $u['turno'];?></td>
                        <td><?php echo $u['motivo'];?></td>
                        <td><?php echo $u['observacion'];?></td>
                        <td>
                          <button onclick="button_modalActivarUserEgresado(<?=$u['id_datos_empleados']?>)" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#modalActivarUser"><span class="icon text-white-50"><i class="fas fa-check"></i></span></button>
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



<div class="modal fade" id="modalActivarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><center>Reincorporación del personal <input style="border: none;font-weight: 500;" type="text" name="nombreApelliUser" id="nombreApelliUser"></center></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <center><h5 class="col">Está seguro de la reincorporación?</h5></center>
                <input type="text" hidden name="IDempleados" id="IDempleados">
                <input type="text" hidden name="nombreUser" id="nombreUser">
                <input type="text" hidden name="apellidoUser" id="apellidoUser">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Descartar</button>
                <button class="btn btn-primary" type="button" id="btn-reincorpoUser" onclick="ReincorpoUser();">Aceptar</button>
            </div>
        </div>
    </div>
  </div>
<script src="public/js/register.js"></script>




