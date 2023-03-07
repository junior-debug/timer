<!--style>
  th,td{
    text-align: center;
    font-size: 14px;
  }
</style-->

<div class="container">
  <div class="row">
    <div class="col">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h5 class="m-0 font-weight-bold">Asistencia</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <!--th>Nombre de usuario</th-->
                        <th>Empleado</th>
                        <th>Cargo</th>
                        <th>Servicio</th>
                        <th><a href="" onclick="veass();"> Rotación</a></th>
                        <th>Turno</th>
                        <th>Asistencia</th>
                      </tr>
                    </thead>
                    <tbody>
                   




                      <tr>
                        <?php foreach($listUser as $u) {?>
                        <td><?php echo $u['id_datos_empleados'];?></td>
                        <td><?php echo $u['apellido'].' '.$u['nombre'];?></td>
                        <td><?php echo $u['cargo'];?></td>
                        <td><?php echo $u['servicio'];?></td>
                        <td><?php echo $u['rotacion'];?></td>
                        <td><?php echo $u['turno'];?></td>
                        <td><?php echo $u['cedula'];?></td>
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


<!-- <script src="public/js/register.js"></script> -->




