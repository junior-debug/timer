<script type="text/javascript" src="public/js/reportes.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold">Gestión detallada</h6>
    </div>
    <div class="card-body">
      <form name="resultados" method="POST" action="?view=reportes&mode=descargar">
        <div class="form-group col-lg-3">  
          <label>Desde</label><input type="date" class="form-control" aria-describedby="fecha_d" value="<?=date('Y-m-d')?>" name="fecha_d" id="fecha_d" autofocus />
        </div>
        <div class="form-group col-lg-3">  
          <label>Hasta</label><input type="date" class="form-control" aria-describedby="fecha_h" value="<?=date('Y-m-d')?>" name="fecha_h" id="fecha_h" autofocus />
        </div>
        <div class="form-group col-lg-12">
          <input type="submit" class="btn btn-medium btn-success" value="Descargar" id="btn-buscar">
        </div>
      </form>
    </div>
  </div>
</div>