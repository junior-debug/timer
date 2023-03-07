<!-- <script type="text/javascript" src="public/js/reportes.js"></script>-->
<div class="container-fluid">
  <div class="card shadow mb-4"> 
          
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark" style="">
        HISTÓRICO DE SESIÓN - <?= $apellido .' '. $name?> - ID(<?=$idEmpleado?>)
        <a href="?view=usuarios&mode=HistorySesionAgente" style="float: right;margin-right: 5px;"  class="btn btn-warning">Volver</a>
      </h6><br>
      <a style="color:#0bac1c;" href= "?view=usuarios&mode=descargaReportehistorySesion&desde=<?php echo $as;?>&hasta=<?php echo $bs;?>">
        <font class="text-success">Descarga masiva <?php echo $as.' al '.$bs; ?></font>
      </a>
      

    </div>
    <div class="card-body">
      <script type="text/javascript">
        $(document).ready(function() {
          //$('#tableDos').DataTable();
          $('#dataTable_').DataTable();
        });
      </script>
      <table class="table table-hover" id="dataTable_" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>NOMBRE Y APELLIDO</th>
            <th>SUPERVISOR</th>
            <th>FECHA</th>
            <th>HORA INICIO</th>
            <th>HORA FINAL</th>         
          </tr>
        </thead>
        <tbody>
            <?php 
            if ($consultar) { $i = 1;
              foreach ($consultar as $consult) {
             ?>
            <tr>
              <td><?=$i?></td>
              <td><?= $consult['nombre'].' '.$consult['apellido'] ?></td>
              <?php
                if ($consult['supervisor'] != 0) {
                    for ($d=0; $d < count($listSupervisor) ; $d++) { 
                      if ( $consult['supervisor'] == $listSupervisor[$d]['id_datos_empleados']) {
          echo            '<td>'. utf8_decode($listSupervisor[$d]['nombre']).' '.utf8_decode($listSupervisor[$d]['apellido']).'</td>';
                      }
                    }
                  }else{
          echo        '<td> </td>';
                  }

              ?>

              <td><?= $consult['fechaHistori'] ?></td>
              <td><?= $consult['horaInicio'] ?></td>
              <td><?= $consult['horaFin'] ?></td>
            </tr>
          <?php $i++;} }else{} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


