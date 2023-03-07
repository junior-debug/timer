<script type="text/javascript">
function mayus(e) {
  e.value = e.value.toUpperCase();
}
</script> 

<div class="container">
    <?php
      if(isset($_GET['msj']) =='exito') {
        echo '  <div class="alert alert-success" role="alert" style="text-align:center; color:#498849;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="">Subida exitosa.</span>
            </div>';

      }else{}
    ?>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold text-dark">CARGA MASIVA</h6>
              </div>
              <div class="card-body">
                <a style="color:#0bac1c; float: right;" id="botonDescargarExcell" download>Descargar Formato Modelo</a><br><br>
                <center><h6 class="m-0 font-weight-bold">Recuerde que el archivo debe ser  extensión .csv <aa style="color:#f416f1;">(CSV (delimitado por comas)) </aa> </h6></center><br>
                
                <form action="?view=usuarios&mode=registroNewMasivo" enctype="multipart/form-data" method="post" id="form" onsubmit="/*return fff();*/">
                  <div class="row" id="bloque1" style="display:;">
                    <div class="col-md-12"> 
                      <div class="md-form">
                        <div class="btn btn-success btn-block">
                          <center>
                            <span>Adjunte el archivo</span>
                            <input  id="archivo" type="file" name="archivo" required ><!--onchange="valida_extension(this.value);"-->
                          </center>
                        </div>  
                        <center><h4 class="text-danger" id="error1" style="display:none;">No se ha seleccionado ningún archivo</h4></center>
                        <center><h4 class="text-danger" id="error2" style="display:none;">Extension Incorrecta</h4></center>
                      </div>
                    </div>
                    <div class="col-md-12" id="boton_subir"><br>
                      <center><button id="botonS" class="btn btn-success">Cargar</button></center>
                    </div>
                  </div>
                </form>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="public/js/register.js"></script>