<script type="text/javascript" src="public/js/bandeja.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold">Bandeja de casos</h6>
    </div>
    <div class="card-body">
      <form name="formBandeja" method="POST" action="?view=bandeja&mode=index">
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col">
                  <span class="form-group">Estatus</span>
                  <select class="form-control" name="f_estatus" id="f_estatus" >
                    <option value="" disabled selected style="display:none;">Seleccione...</option>
                    <option value="1" style="display:enable;">PENDIENTE</option>
                    <option value="3" style="display:enable;">RESUELTO</option>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success btn-icon-split btn-sm">
              <span class="icon text-white-50">
                <i class="fas fa-check"></i>
              </span>
              <span class="text">Filtrar</span>
            </button>
          </div>
        </div>
      </form>

      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" cellspacing="0">
              <thead>
                <tr>
                  <th>Caso</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Fecha creación</th>
                  <th>Categoria</th>
                  <th>Estatus</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php foreach ($casos as $c) {?>
                  <th><a href="?view=bandeja&mode=caso&id=<?=$c['id_gestion'];?>"><?php echo $c['id_gestion']; ?></a></th>
                  <td><?php echo $c['nombre']; ?></td>
                  <td><?php echo $c['apellido']; ?></td>
                  <td><?php echo $c['fecha']; ?></td>
                  <td><?php echo $c['categoria2']; ?></td>
                  <?php if($c['estatus'] == "PENDIENTE"){ $class = "text-warning"; $icon = '<i class="fas fa-exclamation-triangle"></i>'; }else{$class = "text-success"; $icon = '<i class="fas fa-check"></i>';}?>
                  <td class="<?=$class?>"><?php echo $icon.' '.$c['estatus'];?></td>
                </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <form name="formDescarga" method="POST" action="?view=bandeja&mode=descargar">
      <button type="submit" class="btn btn-success btn-icon-split btn-sm" id="btn-descargar">
        <span class="icon text-white-50">
          <i class="fas fa-check"></i>
        </span>
        <span class="text">Descargar casos pendientes</span>
      </button>
    </form>
    </div>
  </div>
</div>
