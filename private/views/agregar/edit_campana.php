<script type="text/javascript" src="public/js/agregar.js"></script>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary text-dark">
      <h6 class="m-0 font-weight-bold">Datos del cargo <?=$DatosCampanna[0]['name_campana']?>.</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <a href="?view=agregar&mode=index_" > <button data-toggle="tooltip" data-placement="top"data-original-title="Volver Atrás" class="btn btn-warning" id="volver" style="float:right">Volver Atrás</button></a>
                        <h5 class="card-title"><strong style="color: black;">Datos de la campaña</strong></h5><br>
                        <hr>
                        <!--    onsubmit="return submitformEditCargo();"   -->
                        <form id="formularioEditCampana"  action="?view=agregar&mode=informacion_editcampana_" method="POST" enctype="multipart/form-data">
                            <input type="text" class="form-control" style="display: none;" id="id_campana" name="id_campanaa" value="<?=$DatosCampanna[0]['id_campana']?>">

                            <div id="cajaDatosCliente">
                                <div class="form-group row center-block">
                                    <div class="col-sm-3">
                                        <label>Campaña</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Abreviación</label>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-3">
                                        <input type="text"  required value="<?=$DatosCampanna[0]['name_campana']?>" id="name_campanaEditar" name="name_campanaEdit" class="form-control" onkeyup="mayus(this);">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text"  required value="<?=$DatosCampanna[0]['abrev_campana']?>" id="abrev_campanaEditar" name="abrev_campanaEdit" class="form-control" onkeyup="mayus(this);">
                                    </div>
                                </div>
                            </div>

                            <center>
                                <button class="mt-2 btn btn-primary" id="botonEditCampana">Actualizar</button> <!---->
                            </center> <br><br>
                        </form>
                                                   
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
</div>