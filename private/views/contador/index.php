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
  document.onkeydown=checkKeyCode; 
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
                <h6 class="m-0 font-weight-bold text-dark">CONTADOR <!--<?=$_SESSION['id']. ' '.$_SESSION['nombre']. ' '.$_SESSION['apellido']. ' '.$_SESSION['user']?>--> </h6><br>
              </div>
              <div class="card-body">
                  <style type="text/css">
                      .visually-hidden{color: #000; font-weight: 500}

                      #timer .container{border-radius:15px; display:table;background:#777;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer .container .divider{width:10px;color:#ddd;}

                      #timer_Bre .container{border-radius:15px; display:table;background:#2868ab;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer_Bre .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer_Bre .container .divider_Bre{width:10px;color:#ddd;}

                      #timer_Entr .container{border-radius:15px; display:table;background:#2868ab;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer_Entr .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer_Entr .container .divider_Entr{width:10px;color:#ddd;}

                      #timer_FBack .container{border-radius:15px; display:table;background:#2868ab;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer_FBack .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer_FBack .container .divider_FBack{width:10px;color:#ddd;}

                      #timer_Bano .container{border-radius:15px; display:table;background:#2868ab;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer_Bano .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer_Bano .container .divider_Bano{width:10px;color:#ddd;}

                      #timer_LLSa .container{border-radius:15px; display:table;background:#2868ab;color:#eee;font-weight:bold;width:max-content;text-align:center;text-shadow:1px 1px 4px #999;}
                      #timer_LLSa .container div{display:table-cell;font-size:20px;padding:5px;width:10px;}
                      #timer_LLSa .container .divider_LLSa{width:10px;color:#ddd;}
                  </style>
                      <input class="form-control" readonly hidden type="text" id="h1" value="<?=$h1?>"><!-- tiempo_ready -->
                      <input class="form-control" readonly hidden type="text" id="m1" value="<?=$m1?>">
                      <input class="form-control" readonly hidden type="text" id="s1" value="<?=$s1?>">

                      <input class="form-control" readonly hidden type="text" id="h2" value="<?=$h2?>"><!-- break -->
                      <input class="form-control" readonly hidden type="text" id="m2" value="<?=$m2?>">
                      <input class="form-control" readonly hidden type="text" id="s2" value="<?=$s2?>">

                      <input class="form-control" readonly hidden type="text" id="h3" value="<?=$h3?>"><!-- bath -->
                      <input class="form-control" readonly hidden type="text" id="m3" value="<?=$m3?>">
                      <input class="form-control" readonly hidden type="text" id="s3" value="<?=$s3?>">

                      <input class="form-control" readonly hidden type="text" id="h4" value="<?=$h4?>"><!-- entrenamiento -->
                      <input class="form-control" readonly hidden type="text" id="m4" value="<?=$m4?>">
                      <input class="form-control" readonly hidden type="text" id="s4" value="<?=$s4?>">

                      <input class="form-control" readonly hidden type="text" id="h5" value="<?=$h5?>"><!-- feek_back -->
                      <input class="form-control" readonly hidden type="text" id="m5" value="<?=$m5?>">
                      <input class="form-control" readonly hidden type="text" id="s5" value="<?=$s5?>">

                      <input class="form-control" readonly hidden type="text" id="h6" value="<?=$h6?>"><!-- llamada_saliente -->
                      <input class="form-control" readonly hidden type="text" id="m6" value="<?=$m6?>">
                      <input class="form-control" readonly hidden type="text" id="s6" value="<?=$s6?>">
                <div class="row">
                  <div class="col-3">
                    <label for="" class="visually-hidden text-success"><strong>TIEMPO READY</strong></label>
                      <button style="display: none;" class="btn btn-primary" id="buttonReadyPlay">READY</button>
                      <button style="display: none;" class="btn btn-warning" id="buttonReadyPause">READY</button>

                    <input class="form-control" readonly hidden type="text" id="valorTime" name="">
                    <input class="form-control" readonly hidden type="text" id="idUsuario" name="idUsuario" value="<?=$_SESSION['id']?>">
                  </div>
                  <div class="col-3"> 
                    <div class="col-auto" id="timer">
                      <div class="container">
                        <div id="hour">00</div>
                        <div class="divider">:</div>
                        <div id="minute">00</div>
                        <div class="divider">:</div>
                        <div id="second">00</div>                
                      </div>
                    </div>
                  </div>
                  <div class="offset-md-3"><!--href="?view=session&mode=disconect"-->
                    <?php if ($_SESSION['cargo'] != 'CLIENTE') {?>
                      <a style="float: right;margin-left: 40px;color:#fff;" class="btn btn-danger" id="buttonFinSesion">Fin de sesión</a>
                    <?php } else{?>
                      <button disabled style="float: right;margin-left: 40px;color:#fff;" class="btn btn-danger" id="">Fin de sesión</button>
                    <?php }?>
                  </div>
                </div>    
                <br> 
                <span id="msjTimerBR" style="display: none; color:red;"><h5>Tiempo superado.</h5></span> 
                <span id="msjTimerEN" style="display: none; color:red;"><h5>Tiempo superado.</h5></span> 
                <span id="msjTimerFB" style="display: none; color:red;"><h5>Tiempo superado.</h5></span>            
                <span id="msjTimerBA" style="display: none; color:red;"><h5>Tiempo superado.</h5></span> 
                <span id="msjTimerLL" style="display: none; color:red;"><h5>Tiempo superado.</h5></span> 
                <br>
                <div class="row">
                  <div class="col-7">
                    <div class="row">
                      <div class="col-2">
                        <button type="button" class="btn btn-primary" id="buttonBreakPlay"  data-toggle="tooltip" data-placement="top" title="Play">BR</button>
                        <button style="display: none;" type="button" class="btn btn-warning" id="buttonBreakPause" data-toggle="tooltip" data-placement="top" title="Pause">BR</button>
                      </div>

                      <div class="col-4">
                        <input class="form-control" readonly type="text" id="valorTimeBreak" name=""  placeholder="00:00:00">
                      </div>
                      <div style="display:none;" class="col-3" id="bloqueTimeBreak">
                        <div class="col-auto" id="timer_Bre">
                          <div class="container containerBre">
                            <div id="hour_Bre">00</div>
                            <div class="divider_Bre">:</div>
                            <div id="minute_Bre">00</div>
                            <div class="divider_Bre">:</div>
                            <div id="second_Bre">00</div>             
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-2">
                        <button type="button" class="btn btn-primary" id="buttonEntrPlay"  data-toggle="tooltip" data-placement="top" title="Play">EN</button>
                        <button style="display: none;" type="button" class="btn btn-warning" id="buttonEntrPause" data-toggle="tooltip" data-placement="top" title="Pause">EN</button>
                      </div>
                      <div class="col-4">
                        <input class="form-control" readonly type="text" id="valorTimeEntr" name="" placeholder="00:00:00">
                      </div>
                      <div style="display:none;" class="col-3" id="bloqueTimeEntr">
                        <div class="col-auto" id="timer_Entr">
                          <div class="container containerEntr">
                            <div id="hour_Entr">00</div>
                            <div class="divider_Entr">:</div>
                            <div id="minute_Entr">00</div>
                            <div class="divider_Entr">:</div>
                            <div id="second_Entr">00</div>             
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-2">
                        <button type="button" class="btn btn-primary" id="buttonFBackPlay"  data-toggle="tooltip" data-placement="top" title="Play">FB</button>
                        <button style="display: none;" type="button" class="btn btn-warning" id="buttonFBackPause" data-toggle="tooltip" data-placement="top" title="Pause">FB</button>
                      </div>
                      <div class="col-4">
                        <input class="form-control" readonly type="text" id="valorTimeFBack" name="" placeholder="00:00:00">
                      </div>
                      <div style="display:none;" class="col-3" id="bloqueTimeFBack">
                        <div class="col-auto" id="timer_FBack">
                          <div class="container containerFBack">
                            <div id="hour_FBack">00</div>
                            <div class="divider_FBack">:</div>
                            <div id="minute_FBack">00</div>
                            <div class="divider_FBack">:</div>
                            <div id="second_FBack">00</div>             
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-2">
                        <button type="button" class="btn btn-primary" id="buttonBanoPlay"  data-toggle="tooltip" data-placement="top" title="Play">BA</button>
                        <button style="display: none;" type="button" class="btn btn-warning" id="buttonBanoPause" data-toggle="tooltip" data-placement="top" title="Pause">BA</button>
                      </div>
                      <div class="col-4">
                        <input class="form-control" readonly type="text" id="valorTimeBano" name="" placeholder="00:00:00">
                      </div>
                      <div style="display:none;" class="col-3" id="bloqueTimeBano">
                        <div class="col-auto" id="timer_Bano">
                          <div class="container containerBano">
                            <div id="hour_Bano">00</div>
                            <div class="divider_Bano">:</div>
                            <div id="minute_Bano">00</div>
                            <div class="divider_Bano">:</div>
                            <div id="second_Bano">00</div>             
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-2">
                        <button type="button" class="btn btn-primary" id="buttonLLSaPlay"  data-toggle="tooltip" data-placement="top" title="Play">LL</button>
                        <button style="display: none;" type="button" class="btn btn-warning" id="buttonLLSaPause" data-toggle="tooltip" data-placement="top" title="Pause">LL</button>
                      </div>
                      <div class="col-4">
                        <input class="form-control" readonly type="text" id="valorTimeLLSa" name="" placeholder="00:00:00">
                      </div>
                      <div style="display:none;" class="col-3" id="bloqueTimeLLSa">
                        <div class="col-auto" id="timer_LLSa">
                          <div class="container containerLLSa">
                            <div id="hour_LLSa">00</div>
                            <div class="divider_LLSa">:</div>
                            <div id="minute_LLSa">00</div>
                            <div class="divider_LLSa">:</div>
                            <div id="second_LLSa">00</div>             
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--________BOTONERA_____ SECCION 2 -->
                  <div class="col-5">
                    <input class="form-control" readonly hidden  type="text" id="timerReady_" value="<?=$timerReady?>" name="">

                    <input class="form-control" readonly  hidden type="text" id="valorCampanaIni" value="<?=$campanaUsers?>" name="">
                    <input class="form-control" readonly  hidden type="text" id="valorCampanaAntiguo" value="" name="">
                    <input class="form-control" readonly  hidden type="text" id="valorCampanaIniU" value="" name="">
                    <input class="form-control" readonly  hidden type="text" id="valorCampanaVariable" name=""><br>

                    <input class="form-control" readonly hidden  type="text" id="tiempoAnterior" name="">
                    <input class="form-control" readonly hidden  type="text" id="tiempoActual" name="">
                    <input class="form-control" readonly hidden  type="text" id="tiempoResultante" name="">

                    <input class="form-control" readonly  hidden type="text" id="valorIdHistoriSesion" name="" value="">

                  <?php
                    $cont = 0;

                    echo '<input class="form-control" hidden readonly  type="text" id="contCampan" name="contCampan" value="'.count($consultarSerCamp).'"> <br>';
                    echo '  <div class="row">';

                    if (count($consultarSerCamp) >1) {
                      for ($k=0; $k < count($consultarSerCamp) ; $k++) { 
                        $cont++;

                        echo '  <div class="col-6">';
                                  if ($consultarSerCamp[$k]['abrev_campana'] == $campanaUsers) {
                        echo '      
                                    <button style="width: 60%;" type="button" class="mt-1 btn btn-info boton" id="buttonCAMPlay'.$k.'" value="'.$consultarSerCamp[$k]['abrev_campana'].'?/?'.$k.'" data-toggle="tooltip" data-placement="top" title="Play">'.$consultarSerCamp[$k]['abrev_campana'].'
                                    </button>';

                                  }else{
                         echo '      
                                    <button style="width: 60%;" type="button" class="mt-1 btn btn-dark boton" id="buttonCAMPlay'.$k.'" value="'.$consultarSerCamp[$k]['abrev_campana'].'?/?'.$k.'" data-toggle="tooltip" data-placement="top" title="Play">'.$consultarSerCamp[$k]['abrev_campana'].'
                                    </button>';           
                                  }
                        echo '  </div><br><br>';
                          
                      }
                      echo '</div>';
                    }
                  ?>
                  <!--<button  style="width: 60%;" type="button" class="btn btn-danger" id="buttonSeguirbb" value=" " data-toggle="tooltip" data-placement="top" title=""> Seguir</button>-->

                  </div>
                </div>

                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="public/js/contador.js"></script>