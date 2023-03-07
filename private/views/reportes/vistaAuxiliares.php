<script type="text/javascript" src="public/js/reportes.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark" style="color: #000;">AUXILIARES</h6>
    </div>
    <div class="card-body">
      <form name="resultados" method="POST" action="?view=reportes&mode=consulta_auxiliar">
        <div class="form-row">
          <div class="form-group col-lg-3">  
            <label>Desde</label>
            <input type="date" class="form-control" aria-describedby="fecha_d" value="<?=date('Y-m-d')?>" name="fecha_d" id="fecha_d" autofocus required/>
          </div>
          <div class="form-group col-lg-3">  
            <label>Hasta</label>
            <input type="date" class="form-control" aria-describedby="fecha_h" value="<?=date('Y-m-d')?>" name="fecha_h" id="fecha_h" autofocus required/>
          </div>
          <!-- <div class="form-group col-lg-3">  
            <label>Auxiliares</label>
            <select class="form-control" name="auxiliar_" id="auxiliar_" required>
              <option selected></option>
              <option value="break">BREAK</option>
              <option value="bath">BAÑO</option>                      
              <option value="entrenamiento">ENTRENAMIENTO</option>
              <option value="feek_back">FEED BACK</option>
              <option value="llamada_saliente">LLAMADAS SALIENTES</option>
            </select>
          </div>-->
        </div>

        <div class="form-group col-lg-3">
          <input type="submit" class="btn btn-medium btn-success" value="Buscar" id="btn-buscar">
        </div>
      </form>
    </div>
  </div>
</div>