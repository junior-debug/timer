<script type="text/javascript" src="public/js/reportes.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark" style="color: #000;"> AUXILIARES
      <a href="?view=reportes&mode=auxiliar" style="float: right;margin-right: 5px;"  class="btn btn-warning">Volver</a></h6>
      <br>
      <a style="color:#0bac1c;" href= "?view=reportes&mode=descargaReporteConsulta_auxiliar&desde=<?php echo $a;?>&hasta=<?php echo $b;?>">
        <font>Descarga de auxiliares <?php echo $a.' al '.$b; ?></font>
      </a>
    </div>
    <div class="card-body"><br>
      <table class="table table-hover" id="dataTable" cellspacing="0">
        <thead>
          <tr>
            <!-- 
            <th>ID REGISTRO</th>
            <th>ID USUARIO</th> -->
            <th>ID USUARIO</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>SERVICIO (CAMPAÑA)</th>
            <th>CAMPAÑA</th>
            <th>SUPERVISOR</th>
            <th>CARGO</th>
            <th>FECHA</th>
            <th>TIEMPO READY</th>
            <th>BREAK</th>
            <th>BAÑO</th>
            <th>ENTRENAMIENTO</th>
            <th>FEEK BACK</th>
            <th>LLAMADAS SALIENTES</th>
            <th>HORA INICIO</th>
            <th>HORA FINAL</th>         
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
            if ($consultar) {
              foreach ($consultar as $consult) {
                $timerMaxBreak    = '00:00:20';
                $timerMaxEntre    = '01:00:15';
                $timerMaxBA_FB_LL   = '00:00:30';

                if ($consult['break'] >= $timerMaxBreak) {
                  $cssBR = 'style= "color:red; font-weight:700;"';
                }else{
                  $cssBR = '';
                }

                if ($consult['entrenamiento'] >= $timerMaxEntre) {
                  $cssEN = 'style= "color:red; font-weight:700;"';
                }else{
                  $cssEN = '';
                }

                if ($consult['bath'] >= $timerMaxBA_FB_LL) {
                  $cssBA = 'style= "color:red; font-weight:700;"';
                }else{
                  $cssBA = '';
                }

                if ($consult['feek_back'] >= $timerMaxBA_FB_LL) {
                  $cssFB = 'style= "color:red; font-weight:700;"';
                }else{
                  $cssFB = '';
                }

                if ($consult['llamada_saliente'] >= $timerMaxBA_FB_LL) {
                  $cssLL = 'style= "color:red; font-weight:700;"';
                }else{
                  $cssLL = ''; 
                }

          ?>
            <tr>
              <!-- 
              <td><?= $consult['id_registro'] ?></td>
              <td><?= $consult['id_user'] ?></td> -->
              <td><?= $consult['id_datos_empleados']?></td>
              <td><?= $consult['nombre'] ?></td>
              <td><?= $consult['apellido'] ?></td>
              <td><?= $consult['servicio']?></td>
              <td><?= $consult['name_campana']?></td>
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
               <td><?= $consult['cargo'] ?></td>
              <td><?= $consult['dia'] ?></td>
              <td><?= $consult['tiempo_ready'] ?></td>
              <td <?=$cssBR?> ><?= $consult['break'] ?></td>
              <td <?=$cssBA?> ><?= $consult['bath'] ?></td>
              <td <?=$cssEN?> ><?= $consult['entrenamiento'] ?></td>
              <td <?=$cssFB?> ><?= $consult['feek_back'] ?></td>
              <td <?=$cssLL?> ><?= $consult['llamada_saliente'] ?></td>
              <td><?= $consult['hora_inicio'] ?></td>
              <td><?= $consult['hora_fin'] ?></td>
            </tr>
          <?php $i++; } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>