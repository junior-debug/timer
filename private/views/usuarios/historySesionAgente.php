<script type="text/javascript" src="public/js/register.js"></script> <!---->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark">HISTÓRICO DE SESIÓN <br><br></h6> <a style="color:#0bac1c;" href= "?view=usuarios&mode=descargaReportehistorySesion&desde=<?php echo date("Y-m-d");?>&hasta=<?php echo date("Y-m-d");?>"> <font>Descarga del día de hoy <?php echo date("Y-m-d");?></font></a> 
    </div>
    <div class="card-body">

    <script type="text/javascript">
      $(document).ready(function(){
        $("#busquedaAgent").keyup(function () {
          var value = $(this).val();
          //alert(value)
          $.ajax({
            type:'POST',
            url:'?view=usuarios&mode=busquedaAgenteHistory',
            dataType: "json",
            data:{texto:value},
            success:function(datos){
                //alert(datos.result)
                if (datos.response == 'true') {
                  //$("#busquedaAgent").hide();
                  $("#bloqueAgente").html(datos.result)
                
                }else{
                  //$("#busquedaAgent").show();
                  $("#bloqueAgente").html(datos.result)
                }
            }
          })

          //$("#bloqueAgente").text(value);
        }).keyup();
      });
    </script>



      <form name="resultados" method="POST" action="?view=usuarios&mode=consulta_historySesion">
        <div class="form-row">
          <div class="form-group col-lg-3">  
            <label>Desde</label>
            <input type="date" class="form-control" aria-describedby="fecha_d" value="<?=date('Y-m-d')?>" name="fecha_d" id="fecha_d" autofocus required/>
          </div>
          <div class="form-group col-lg-3">  
            <label>Hasta</label>
            <input type="date" class="form-control" aria-describedby="fecha_h" value="<?=date('Y-m-d')?>" name="fecha_h" id="fecha_h" autofocus required/>
          </div>
          <div class="form-group col-lg-3">  
            <label for="busquedaAgent" class="form-label">Agentes</label>
            <input class="form-control" id="busquedaAgent" name="busquedaAgent" placeholder="Type to search...">
          </div>
          <div class="form-group col-lg-3">  
            <label for="" class="form-label"><br></label>
            <div id="bloqueAgente">   </div>
          </div>
          
        </div>

        <div class="form-group col-lg-3">
          <input type="submit" class="btn btn-medium btn-success" value="Buscar" id="btn-buscar">
        </div>
      </form>
    </div>
  </div>
</div>