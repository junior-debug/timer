<div class="container">
  <div class="row">
    <div class="col-1"></div>
    <div class="col-9">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold text-dark">CAMBIO DE CLAVE</h6>
              </div>
              <div class="card-body">
                <form role="form" name="f_cambioClave" id="f_cambioClave" autocomplete="off">
                    <input class="form-control" readonly hidden type="text" id="idUsuarioPassword" name="idUsuarioPassword" value="<?=$_SESSION['id']?>">
                    <div class="form-group row">
                      <div class="col-sm-5">
                        <div class="form-group row">
                          <label for="pass_index" class="col-sm-4 col-form-label col-form-label-sm">Ingrese clave</label>
                          <div class="col-sm-6">
                            <input type="password" id="pass_CambioUno" onchange="validar_clave_(this.value)"  value="" class="form-control col-form-label-sm" placeholder="" name="pass_index" required />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="pass_index" class="col-sm-4 col-form-label col-form-label-sm">Repetir clave</label>
                          <div class="col-sm-6">
                            <input disabled type="password" id="pass_CambioDos"  value="" class="form-control col-form-label-sm" placeholder="" name="pass_index" required />
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-7">
                        <ol>
                          <li id="list1">La clave debe tener al menos 6 caracteres</li>
                          <li id="list2">La clave no puede tener más de 16 caracteres</li>
                          <li id="list3">La clave debe tener al menos una letra minúscula</li>
                          <li id="list4">La clave debe tener al menos una letra mayúscula</li>
                          <li id="list5">La clave debe tener al menos un caracter numérico</li>
                        </ol>
                        <input hidden type="text" id="list1_" >
                        <input hidden type="text" id="list2_" >
                        <input hidden type="text" id="list3_" >
                        <input hidden type="text" id="list4_" >
                        <input hidden type="text" id="list5_" >
                      </div>
                    </div>
                    <input id="btn_registerPassword" name="btn_registerPassword" type="button" class="btn btn-md btn-success" value="Guardar" />

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