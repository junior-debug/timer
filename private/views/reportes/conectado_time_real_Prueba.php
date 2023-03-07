 <script type="text/javascript" src="public/js/reportes.js"></script><!---->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold" style="color: #000;">Conexión tiempo real</h6>
      <a onclick="buscarInstant();"  style="float: right;margin-right: 5px;"  class="btn btn-warning">Actualizar</a>
    </div>

    <script type="text/javascript"> 
      //Para bloquear tecla F5 y F6
      function checkKeyCode(evt){
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);

        if(event.keyCode==116 || event.keyCode==117){
          evt.keyCode=0;
          return false
        }
      }
      document.onkeydown=checkKeyCode
      //___________________________________________________________________
      setInterval(function(){
        $.ajax({
          type:'POST',
          url:'?view=reportes&mode=busqueda_time_real_Prueba',
          dataType: "json",
          /*data:{ time:time, time_Bre:time_Bre, time_Entr:time_Entr, time_FBack:time_FBack, time_Bano:time_Bano, time_LLSa:time_LLSa, idUsuario: $('#idUsuario').val()},*/
          success:function(datos){ 
              //alert(datos.response)
            if (datos.response == 'true') {
              //$("#busquedaAgent").hide();
              $("#bloquetimeReal").html(datos.result)
                
            }else{
              //$("#busquedaAgent").show();
              $("#bloquetimeReal").html(datos.result)
            }
          }
        })
      },5000);/**/

      function cancelar_sesion(e){
        $('#id_datos_personales').val(e)
        $('#cierreDeSesion').modal('show');
        //alert(e)
      }

      function buscarInstant(){
          $.ajax({
            type:'POST',
            url:'?view=reportes&mode=busqueda_time_real',
            dataType: "json",
            /*data:{ time:time, time_Bre:time_Bre, time_Entr:time_Entr, time_FBack:time_FBack, time_Bano:time_Bano, time_LLSa:time_LLSa, idUsuario: $('#idUsuario').val()},*/
            success:function(datos){ 
                //alert(datos.response)
              if (datos.response == 'true') {
                //$("#busquedaAgent").hide();
                $("#bloquetimeReal").html(datos.result)
                  
              }else{
                //$("#busquedaAgent").show();
                $("#bloquetimeReal").html(datos.result)
              }
            }
          })
      }
    </script>

    <div class="card-body">
      <div id="bloquetimeReal">   </div>
    </div>
  </div>
</div>

<!--  -->
<div class="modal fade" id="cierreDeSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seguro del cierre de sesión?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <input class="form-control" readonly hidden  type="text" id="id_datos_personales" value="">
           <!-- <div class="modal-body">
                <div class="col form-group">
                    <span class="col">Motivo de egreso</span>
                    <select class="selectpicker show-menu-arrow show-tick form-control" name="razonDelete" id="razonDelete" required>
                        <option value="" disabled selected style="display:none;">Seleccione...</option>
                        <option value="ABANDONO">ABANDONO</option>
                        <option value="FINALIZACIÓN DE PRIMER CONTRATO">FINALIZACIÓN DE PRIMER CONTRATO</option>
                        <option value="FINALIZACIÓN DE SEGUNDO CONTRATO">FINALIZACIÓN DE SEGUNDO CONTRATO</option>
                        <option value="RENUNCIA">RENUNCIA</option>
                    </select>
                    <input type="text" hidden  name="id_datos_empleadosDelete" id="id_datos_empleadosDelete">
                    <input type="text" hidden  name="nombreUser" id="nombreUser">
                    <input type="text" hidden  name="apellidoUser" id="apellidoUser">
                    <input type="text" hidden  name="nombreApelliUser" id="nombreApelliUser">
                </div>
                <div class="col form-group">
                    <span class="col">Observaciones</span>
                    <textarea class="form-control" rows=3 maxlength="250" name="observacionesDelete" id="observacionesDelete" onkeyup="mayus(this);" required></textarea>
                </div>
            </div>-->
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Descartar</button>
                <button class="btn btn-primary" type="button" id="" onclick="accion();">Aceptar</button>
            </div>
        </div>
  </div>
</div>