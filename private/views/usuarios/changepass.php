<script type="text/javascript">
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
  
  function mostrarContrasena1(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
      tipo.type = "text";
    }else{
      tipo.type = "password";
    }
  }

  function mostrarContrasena2(){
    var tipo = document.getElementById("password_");
    if(tipo.type == "password"){
      tipo.type = "text";
    }else{
      tipo.type = "password";
    }
  }
</script>

<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="form-group">
            <div class="card shadow mb-4">
              <div class="card-header py-3 border-bottom-primary">
                <h6 class="m-0 font-weight-bold">Cambio de contraseña</h6>
              </div>
              <div class="card-body">
                <form id="actualizaContrasena" enctype="multipart/form-data" method="POST" action="?view=usuarios&mode=actualizaPassword">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="mostrarContrasena1()">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                          </svg>
                        </button>
                      </span>
                      <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="mostrarContrasena2()">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                          </svg>
                        </button>
                      </span>
                      <input type="password" id="password_" name="password_" class="form-control" placeholder="Repita la contraseña">
                    </div>
                  </div>
                  <div id="mensaje" style="color: red;" hidden>
                    No coinciden las contraseñas
                  </div>

                  <input type="hidden" name="user" id="user" value="<?=$_SESSION['id']?>">
                  <button id="btn-actualiza" name="btn-actualiza" type="submit" class="btn btn-info btn-block">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function(){
  $("#password_").keyup(function(){
    if($('#password').val() == $('#password_').val()){
      $('#mensaje').hide();
      if ($('#password_').val() == 123456){
        alert('La contraseña no puede ser igual a 123456.');
      }
    }else{
      $('#mensaje').show();
    }
  });
})  
</script>