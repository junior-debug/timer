<!-- <script type="text/javascript" src="public/js/reportes.js"></script>-->
<div class="container-fluid">
  <div class="card shadow mb-4">
          
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark" style="color: #000;"> CONEXIÓN POR AGENTE - <?= $apellido .' '. $name?></h6>
      <a href="?view=reportes&mode=conexionxagente" style="float: right;margin-right: 5px;"  class="btn btn-warning">Volver</a>
    </div>
    <div class="card-body">
      <script type="text/javascript">
        $(document).ready(function() {
          $('#tableDos').DataTable();
          $('#dataTable_').DataTable();
        });
      </script>
      <table class="table table-hover" id="dataTable_" cellspacing="0">
        <thead>
          <tr>
            <th>ID USUARIO</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>FECHA</th>
            <th>TIEMPO READY</th>
            <th>BREAK</th>
            <th>BAÑO</th>
            <th>ENTRENAMIENTO</th>
            <th>FEED BACK</th>
            <th>LLAMADAS SALIENTES</th>
            <th>HORA INICIO</th>
            <th>HORA FINAL</th>         
          </tr>
        </thead>
        <tbody>
            <?php 
            if ($consultar) {
              foreach ($consultar as $consult) {
                $timerMaxBreak    = '00:59:59';
                $timerMaxEntre    = '01:59:59';
                $timerMaxBA_FB_LL   = '00:15:59';

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
              <td><?= $consult['id_datos_empleados'] ?></td>
              <td><?= $consult['nombre'] ?></td>
              <td><?= $consult['apellido'] ?></td>
              <td><?= $consult['dia'] ?></td>
              <td><?= $consult['tiempo_ready'] ?></td>
              <td <?=$cssBR?>> <?= $consult['break'] ?></td>
              <td <?=$cssBA?>> <?= $consult['bath'] ?></td>
              <td <?=$cssEN?>> <?= $consult['entrenamiento'] ?></td>
              <td <?=$cssFB?>> <?= $consult['feek_back'] ?></td>
              <td <?=$cssLL?>> <?= $consult['llamada_saliente'] ?></td>
              <td><?= $consult['hora_inicio'] ?></td>
              <td><?= $consult['hora_fin'] ?></td>
            </tr>
          <?php } }else{} ?>
        </tbody>
      </table>
    </div>
    <br><br>
    <div class="card-body" style= "background-color: #e0e7fd;">
      <table class="table table-hover" id="tableDos" cellspacing="0">
        <thead>
          <tr>
            <th>ID TABLA</th>
            <th>CAMPAÑA</th>
            <th>HORA INICIO</th>
            <th>HORA FIN</th>
            <th>DURACIÓN</th>  
            <th>FECHA</th>      
          </tr>
        </thead>
        <tbody>
          <?php 
            if ($consultar_) {
              for ($i=0; $i < count($consultar_) ; $i++) {?>
            <tr>
              <td><?= $consultar_[$i]['id_table2'] ?></td>
              <td><?= $consultar_[$i]['campana'] ?></td>
              <td><?= $consultar_[$i]['horaInicio'] ?></td>
              <td><?= $consultar_[$i]['horaFinal'] ?></td>
              <td><?= $consultar_[$i]['duracion'] ?></td>
              <td><?= $consultar_[$i]['dia'] ?></td>
            </tr>
          <?php } }else{} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>