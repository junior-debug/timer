<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3 border-bottom-primary">
      <h6 class="m-0 font-weight-bold text-dark" style="color: #000;">GESTIÓN EN VIVO <?= $_SESSION['totalService'] ?></h6>
      <a onclick="buscarInstant();"  style="float: right;margin-right: 5px;"  class="btn btn-warning text-white">ACTUALIZAR</a>
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
     
      $(document).ready(function() {
        $("#cargo_contadReal_").on('change', function(e){ //alert( $("#cargo_contadReal_").val() )
          if ( $("#cargo_contadReal_").val() == 0) {
            $("#supervisor_contadReal_").removeAttr('disabled','disabled');
            $("#supervisor2_contadReal_").removeAttr('disabled','disabled');

          }else{
            $("#supervisor_contadReal_").val(0);
            $("#supervisor_contadReal_").attr('disabled','disabled');
            $("#supervisor2_contadReal_").val(0);
            $("#supervisor2_contadReal_").attr('disabled','disabled');
          }  
        });

        $("#supervisor_contadReal_").on('change', function(){ //alert( $("#supervisor_contadReal_").val() )
          if ( $("#supervisor_contadReal_").val() == 0) {
            $("#cargo_contadReal_").removeAttr('disabled','disabled');

          }else{
            $("#cargo_contadReal_").val(0);
            $("#cargo_contadReal_").attr('disabled','disabled');
          }
        });
        /*$("#supervisor2_contadReal_").on('change', function(){ alert( $("#supervisor2_contadReal_").val() )
          if ( $("#supervisor2_contadReal_").val() == 0) {
            $("#cargo_contadReal_").removeAttr('disabled','disabled');

          }else{
            $("#cargo_contadReal_").val(0);
            $("#cargo_contadReal_").attr('disabled','disabled');
          }
        });*/
      });

      function selectSuperDos(e){
          if ( e == 0) {
            $("#cargo_contadReal_").removeAttr('disabled','disabled');

          }else{
            $("#cargo_contadReal_").val(0);
            $("#cargo_contadReal_").attr('disabled','disabled');
          }
      }

      function cancelar_sesion(e){
        $('#id_datos_personales').val(e)
        $('#cierreDeSesion').modal('show');
        //alert(e)
      }
      function buscarInstant(){ //alert(' aqui toy ')
        //alert($("#servicio_contadReal_").val())
        var valorServicio     = "";
        var valorCargo        = "";
        var valorSuperv       = "";
        var seleccionCargoo   = $("#cargo_contadReal_").val();
        var sesionCargo       = $("#sessionCargo").val();
        var sesionServicio    = $("#sessionServicio").val();   

        if (sesionCargo == 'ADMINISTRADOR' || sesionCargo == 'GERENTE' || sesionCargo == 'SUPERVISOR') {
          var tipoSupervisor    = $("#tipoSuperv").val();
          if ( tipoSupervisor == 1 ) {
            var seleccionSuperrvi = $("#supervisor_contadReal_").val();
          }else{
            var seleccionSuperrvi = $("#supervisor2_contadReal_").val();
          }

        }else{
           var seleccionSuperrvi = $("#supervisor_contadReal_").val();
        }

          if (sesionCargo == 'ADMINISTRADOR' || sesionCargo == 'GERENTE') {
                var seleccionServi    = $("#servicio_contadReal_").val();
                var partes_     = seleccionServi.split('?/?');
                seleccionServi  = partes_[1];
                valorServicio = seleccionServi;

                //alert( 'seleccionServi: '+ seleccionServi + ' seleccionCargoo: '+ seleccionCargoo + ' seleccionSuperrvi: ' + seleccionSuperrvi )

                if ( seleccionCargoo == '0' ) {
                    if ( seleccionSuperrvi == '0'  || seleccionSuperrvi == null ) {
                      valorCargo      = '0';
                      valorSuperv     = '0';
                    }else{
                      valorCargo      = '0';
                      valorSuperv     = seleccionSuperrvi;
                    }
                
                }else{
                  $("#supervisor_contadReal_").val("");
                  //seleccionSuperrvi = 0;
                  valorCargo        = seleccionCargoo;
                  valorSuperv       = '0';
                }

          }else if (sesionCargo == 'SUPERVISOR') {
                var seleccionServi        = $("#servicio_contadReal_super").val();
                var servicioss_superv     = $("#servicioss_superv").val();

               // alert( 'buscarInstant****' + 'seleccionServi: '+ seleccionServi + 'servicioss_superv: '+ servicioss_superv + ' seleccionCargoo: '+ seleccionCargoo + ' seleccionSuperrvi: ' + seleccionSuperrvi )

                if ( seleccionServi == '0' || seleccionServi == undefined ) {
                    valorServicio = 0; //servicioss_superv;
                
                }else{
                  var partes_     = seleccionServi.split('?/?');
                  seleccionServi  = partes_[1];
                  valorServicio = seleccionServi;

                //  alert( 'buscarInstant ELSE****' + 'seleccionServi: '+ seleccionServi + 'servicioss_superv: '+ servicioss_superv + ' seleccionCargoo: '+ seleccionCargoo + ' seleccionSuperrvi: ' + seleccionSuperrvi )
                }

                if ( seleccionCargoo == '0' ) {
                    if ( seleccionSuperrvi == '0'  || seleccionSuperrvi == null ) {
                      valorCargo      = '0';
                      valorSuperv     = '0';
                    }else{
                      valorCargo      = '0';
                      valorSuperv     = seleccionSuperrvi;
                    }
                
                }else{
                  $("#supervisor_contadReal_").val("");
                  //seleccionSuperrvi = 0;
                  valorCargo        = seleccionCargoo;
                  valorSuperv       = '0';
                }
               // alert( 'buscarInstant****' + 'seleccionServi: '+ seleccionServi + 'servicioss_superv: '+ servicioss_superv + ' seleccionCargoo: '+ seleccionCargoo + ' seleccionSuperrvi: ' + seleccionSuperrvi )
          }else{
                valorServicio = sesionServicio;
                if ( seleccionCargoo == '0' ) {
                    if ( seleccionSuperrvi == '0' || seleccionSuperrvi == null ) {
                      valorCargo      = '0';
                      valorSuperv     = '0';
                    
                    }else{
                      valorCargo      = '0';
                      valorSuperv     = seleccionSuperrvi;
                    }
                
                }else{
                  $("#supervisor_contadReal_").val("");
                  seleccionSuperrvi = 0;
                  valorCargo        = seleccionCargoo;
                  valorSuperv       = '0';
                }
            //alert( ' valorServicio ' +valorServicio + ' valorCargo '+ valorCargo + ' valorSupervisor '+ seleccionSuperrvi)
          }
          
          //alert( 'Ajax ====  valorServicio ' +valorServicio + ' valorCargo '+ valorCargo + ' valorSuperv '+ valorSuperv + '  servicioss_superv ' + servicioss_superv) 

          $.ajax({
            type:'POST',
            url:'?view=reportes&mode=busqueda_time_real',
            dataType: "json",
            data:{valorServicio:valorServicio, valorCargo:valorCargo, valorSuperv:valorSuperv, servicioss_superv:servicioss_superv},
            success:function(datos){ 
                //alert(datos.result)
              if (datos.response == 'true') {
                $("#bloquetimeReal").html(datos.result)
                  
              }else{
                $("#bloquetimeReal").html(datos.result)
              }
            } 
          })/**/
      }
      function accion(){
        var idEmpleado_ = $('#id_datos_personales').val();
        $.ajax({
            type:'POST',
            url:'?view=reportes&mode=consulta__',
            // dataType: "json",
            data:{id_empleado:idEmpleado_},
            success:function(datos){
                $('#cierreDeSesion').modal('hide');
               
            }
        })
      }

      function modalContadorCampana(){
        var valorServicio  = "";
        var seleccionServi = $("#servicio_contadReal_").val();
        var sesionCargo    = $("#sessionCargo").val();
        var sesionServicio = $("#sessionServicio").val();

             // alert(' seleccionServi:  ' +  seleccionServi + ' sesionCargo:  '+ sesionCargo  + ' sesionServicio:  '+ sesionServicio)


        var partes_ = seleccionServi.split('?/?');
        //alert( partes_[0] + ' --> '+ partes_[1])
        seleccionServi = partes_[1];

        if (sesionCargo == 'ADMINISTRADOR') {
          valorServicio = seleccionServi;
        }else{
          valorServicio = sesionServicio;
        }

        $.ajax({
            type:'POST',
            url:'?view=reportes&mode=contadorCampanasxServicio',
            dataType: "json",
            data:{valorServicio:valorServicio},
            success:function(datos){
                if (datos.response == 'true') {
                  $("#bodyCampanasContador").html(datos.result)
                  $('#ContadorCampanas').modal('show');
                    
                }else{
                  $("#bodyCampanasContador").html(datos.result)
                  $('#ContadorCampanas').modal('show');
                }
               
            }
        })
      }

      function selectServiceContadorR_(e){ 
        var partes_ = e.split('?/?');
        //alert(e + ' '+ partes_[0])
        if ( e == '0?/?0') { //alert( ' aqui 0 ')
          $("#tipoSuperv").val(1);
          //$("#supervisor2_contadReal_").val("");
          $("#cargo_contadReal_").removeAttr('disabled','disabled');
          $("#supervisor2_contadReal_ option[value=0]").attr("selected",true);

          $("#Blocksupervisor_contadReal_2").hide();
          $("#Blocksupervisor_contadReal_").show();
          //$("#supervisor_contadReal_").val("");
          $("#supervisor_contadReal_ option[value=0]").attr("selected",true);

        }else{ //alert( ' aqui DISTINTO a  0 ')
          $("#tipoSuperv").val(2);
          $("#cargo_contadReal_").removeAttr('disabled','disabled');
          $.ajax({
            type:'POST',
            url:'?view=reportes&mode=selectSuperxServi_',
            dataType: "json",
            data:{id_servicio: partes_[0], nomber_servi: partes_[1]},
            success:function(datos){  
                //alert(datos)
               // alert(' selectSuperxServi_' +datos.result)

                if(datos.response == 'true'){
                    //$("#supervisor_contadReal_").val("");
                    $("#supervisor_contadReal_ option[value=0]").attr("selected",true);
                    $("#Blocksupervisor_contadReal_").hide();
                    $("#Blocksupervisor_contadReal_2").show();
                    $('#bloqueSuper2').html(datos.result) 
                
                }else{
                    $('#bloqueSuper2').html(datos.result) 
                }

            }
          })
        } 
      }
    </script> 

    <div class="card-body">
      <input type="text" readonly hidden class="form-control" value="<?= $_SESSION['cargo'] ?>" name="sessionCargo" id="sessionCargo" autofocus/>
      <input type="text" readonly hidden class="form-control" value="<?= $_SESSION['id_servicio'] ?>" name="sessionServicio" id="sessionServicio" autofocus/>
        <div class="form-row"> 
      <?php if ( $_SESSION['cargo'] == 'ADMINISTRADOR' ||  $_SESSION['cargo'] == 'GERENTE') { ?>
          <div class="form-group col-md-2">  
            <label for="servicio_" class="form-label">Servicio</label>
              <select class="form-control" id="servicio_contadReal_" name="servicio_contadReal_" required onchange="selectServiceContadorR_(this.value)"> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                <option value="0?/?0">Seleccione...</option>
                <?php 
                foreach($consulta2 as $s) {?>
                    <option  value="<?=$s['idServicio']."?/?".$s['servicios']?>"><?=$s['servicios']?></option>
                <?php } ?>
              </select>
          </div>
      <?php }?>

      <?php if ( $_SESSION['cargo'] == 'COORDINADOR' ||  $_SESSION['cargo'] == 'SUPERVISOR') { 
            if ( $_SESSION['totalService'] === 3) {
      ?>

            <input type="text" id="servicioss_superv" hidden name=""  value="<?=$_SESSION['id_servicio']?>">
              <div class="form-group col-md-2">  
                <label for="servicio_" class="form-label">Servicio achiii</label>
                  <select class="form-control" id="servicio_contadReal_super" name="servicio_contadReal_super" required onchange="selectServiceContadorR_(this.value)"> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                    <option value="0?/?0">Seleccione...</option>
                    <option  value="<?=$_SESSION['idServi1']."?/?".$_SESSION['serviceP1']?>"><?=$_SESSION['serviceP1']?></option>
                    <option  value="<?=$_SESSION['idServi2']."?/?".$_SESSION['serviceP2']?>"><?=$_SESSION['serviceP2']?></option>
                    <option  value="<?=$_SESSION['idServi3']."?/?".$_SESSION['serviceP3']?>"><?=$_SESSION['serviceP3']?></option>
                  </select>
              </div>
      <?php }else if ( $_SESSION['totalService'] === 2) {?>

            <input type="text" id="servicioss_superv" hidden name=""  value="<?=$_SESSION['id_servicio']?>">
              <div class="form-group col-md-2">  
                <label for="servicio_" class="form-label">Servicio achiii</label>
                  <select class="form-control" id="servicio_contadReal_super" name="servicio_contadReal_super" required onchange="selectServiceContadorR_(this.value)"> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                    <option value="0?/?0">Seleccione...</option>
                    <option  value="<?=$_SESSION['idServi1']."?/?".$_SESSION['serviceP1']?>"><?=$_SESSION['serviceP1']?></option>
                    <option  value="<?=$_SESSION['idServi2']."?/?".$_SESSION['serviceP2']?>"><?=$_SESSION['serviceP2']?></option>
                  </select>
              </div>
      <?php
      }else{}}?>

      <?php if ( $_SESSION['cargo'] == 'ADMINISTRADOR' ||  $_SESSION['cargo'] == 'GERENTE'  ||  $_SESSION['cargo'] == 'COORDINADOR' ||  $_SESSION['cargo'] == 'SUPERVISOR') { ?> 
          <div class="form-group col-md-2" id="Blockcargo_contadReal_">  
            <label for="cargo_" class="form-label">Cargo</label>
              <select class="form-control" id="cargo_contadReal_" name="cargo_contadReal_" required> <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                <option value="0">Seleccione...</option>
                <?php 
                foreach($consulta1_2 as $car) {?>
                    <option  value="<?=$car['cargos']?>"><?=$car['cargos']?></option>
                <?php } ?>
              </select>
          </div>
          <input type="text" id="tipoSuperv" name="" hidden  value="1">
          <div class="form-group col-md-2" id="Blocksupervisor_contadReal_"  style="display: block;">  
            <label for="cargo_" class="form-label">Supervisor</label>
              <select class="form-control" id="supervisor_contadReal_" name="supervisor_contadReal_" > <!-- onchange="selectOnchangePosicion_(this.value)"  -->
                <option value="0">Seleccione...</option>
                <?php 
                foreach($consulta1_3 as $consult) {?>
                    <option  value="<?=$consult['id_datos_empleados']?>"><?=$consult['apellido'].' '.$consult['nombre'].' ('.$consult['campana'].')'?></option>
                <?php } ?>
              </select>
          </div> 

          <div class="form-group col-md-2" id="Blocksupervisor_contadReal_2" style="display: none;">  
            <label for="cargo_" class="form-label">Supervisorde</label>
            <div id="bloqueSuper2"> 

            </div>
          </div>

      <?php }?>    
        </div><br>

      <div id="bloquetimeReal">   </div>
    </div>
  </div>
</div>

<!-- MODALLL  -->
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
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Descartar</button>
                <button class="btn btn-primary" type="button" id="" onclick="accion();">Aceptar</button>
            </div>
        </div>
  </div>
</div>

<!-- MODALLL 2  -->
<div class="modal fade" id="ContadorCampanas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-dark" id="exampleModalLabel">Contador por campañas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="bodyCampanasContador">
              
            </div>
            <input class="form-control" readonly hidden  type="text" id="id_datos_personales" value="">
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Aceptar</button>
            </div>
        </div>
  </div>
</div>
<!-- <script type="text/javascript" src="public/js/reportes.js"></script>-->

































































































