<script type="text/javascript" src="public/js/validaciones.js"></script>
<script type="text/javascript" src="public/js/formulario.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row" id="page-top">
    <div class="col col-lg-2"></div>
    <div class=" col-lg-8">

      <div class="card shadow mb-4">
        <a href="#collapseCardClientes" class="card-header py-3 border-bottom-primary" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardClientes"><h6 class="m-0 font-weight-bold" style="color:#858796;">Datos del cliente</h6>
        </a>
        <div class="collapse show" id="collapseCardClientes">      
          <div class="card-body">
            <span class="form-group">Cedula o RIF del cliente</span>
            <div class="row">
              <div class="col-4">
                <input type="text" class="form-control" placeholder="Cedula..." aria-describedby="identificacion" name="identificacion" id="identificacion" maxlength="8" />
              </div>
              <div class="">
                <input type="button" class="btn btn-medium btn-success btb-sm" value="Buscar" id="btn-buscar">
              </div>
              <div class="col-1">
                <button class="btn btn-md btn-warning" id="btn-limpiar"><span class="glyphicon glyphicon-refresh"></span> Limpiar</button>
              </div>
            </div>
            <br>

            <div id="nombreCliente"></div>
            <div id="tablaCasos"></div>
          </div> <!-- FIN DE LA TARJETA -->
        </div>
      </div>
    </div>
  </div>
  

<!-- Content Row -->
  <form name="form" id="form" enctype="multipart/form-data" method="POST" onsubmit="return validaForm(this);" action="?view=formulario&mode=guardar">
    <div class="row" id="formulario">
      <div class="col col-lg-2"></div>
      <div class="col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3 border-bottom-primary">
            <h6 class="m-0 font-weight-bold">Resultado del contacto</h6>
          </div>
          <div class="card-body">
        
           <!-- TIPIFICACIÓN DEL CONTACTO -->
            <div class="form-group">
              <span class="form-group">Origen del contacto</span>
              <select class="selectpicker show-menu-arrow show-tick form-control" name="origenContacto" id="origenContacto" required>
                     <option value="" disabled selected style="display:none;">Seleccione...</option>
                     <option value="CHAT">CHAT</option>
                     <option value="FORMULARIO">FORMULARIO</option>
                     <option value="TWITTER">TWITTER</option>
                     <option value="FACEBOOK">FACEBOOK</option>
                     <option value="INSTAGRAM">INSTAGRAM</option>
                     <option value="BUZON ATC">BUZÓN ATC</option>
              </select>
            </div>

            <div class="form-group">
              <span class="form-group">Tipo de contacto</span>
              <select class="selectpicker show-menu-arrow show-tick form-control" name="tipoContacto" id="tipoContacto" required >
                     <option value="" disabled selected style="display:none;">Seleccione...</option>
                     <option value="CHAT">CHAT</option>
                     <option value="CORREO">CORREO</option>
                     <option value="LLAMADA">LLAMADA</option>
                     <option value="RRSS">RRSS</option>
              </select>
            </div>

            <div class="form-group" id="d_tipoAtencion">
              <span class="form-group">Tipo de atención</span>
              <select class="selectpicker show-menu-arrow show-tick form-control" name="tipoAtencion" id="tipoAtencion">
                     <option value="" disabled selected style="display:none;">Seleccione...</option>
                     <option value="DM">DM</option>
                     <option value="PUBLICO">PÚBLICO</option>
              </select>
            </div>

            <div class="form-group" id="d_efectivo" >
              <span class="form-group">Contacto Efectivo</span>
              <select class="selectpicker show-menu-arrow show-tick form-control" name="tipoEfectivo" id="tipoEfectivo" >
                     <option value="" disabled selected style="display:none;">Seleccione...</option>
                     <option value="SI">SI</option>
                     <option value="NO">NO</option>
              </select>
            </div>

            <div class="form-group" id="d_categoria1">
              <span class="form-group">Categoria 1 del contacto</span>
              <select class="form-control" name="categoria1" id="categoria1">
              <?php foreach ($categoria1 as $cat1) {?>
              <option value="" disabled selected style="display:none;">Seleccione...</option>
              <option value="<?php echo $cat1["id_categoria1"];?>"><?php echo $cat1["descripcion"];}?></option>
              </select>
            </div>

            <div class="form-group" id="d_categoria2">
              <span class="form-group">Categoria 2 del contacto</span>
              <select class="form-control" name="categoria2" id="categoria2"></select>
            </div>

            <div class="form-group" id="d_categoria3">
              <span class="form-group">Categoria 3 del contacto</span>
              <select class="form-control" name="categoria3" id="categoria3"></select>
            </div>

            <div class="form-group" id="d_noefectivo" >
              <span class="form-group">Motivo de <bold class="font-weight-bold">NO</bold> contacto</span>
              <select class="form-control" name="noefectivo" id="noefectivo" >
              <?php foreach ($noefectivo as $ne) { ?>
                <option value="" disabled selected style="display:none;">Seleccione...</option>
                <option value="<?php echo $ne["id_noefectivo"];?>" style="display:enable;"><?php echo $ne["descripcion"];}?></option>
              </select>
            </div>

            <!-- DATOS DEL CLIENTE -->

            <input type="hidden" id="idCliente" name="idCliente">

            <div id="d_cliente_efectivo">
              <div id="datosCliente">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <span class="form-group" id=""><h4>Datos del cliente</h4></span>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Nombre del cliente</span>
                          <input type="text" class="form-control" placeholder="Carolina" aria-describedby="nombre" name="nombre" id="nombre" onkeyup="mayusculas(this);" onkeypress="return soloLetras(event)"/>
                        </div>
                        <div class="col">
                          <span class="form-group">Apellido del cliente</span>
                          <input type="text" class="form-control" placeholder="Perez" aria-describedby="apellido" name="apellido" id="apellido" onkeyup="mayusculas(this);" onkeypress="return soloLetras(event)"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Cedula del cliente</span>
                          <input type="text" class="form-control" placeholder="12456345" aria-describedby="cedula" name="cedula" id="cedula" maxlength="8" onkeypress="return soloNumeros(event)"/>
                        </div>
                        <div class="col">
                          <span class="form-group">Teléfono Domicilio</span>
                          <input type="text" class="form-control" placeholder="02123456789" aria-describedby="telf_hab" name="telf_hab" id="telf_hab" onkeypress="return soloNumeros(event)" onchange="validaTelefono(this);" maxlength="11"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Teléfono Celular</span>
                          <input type="text" class="form-control" placeholder="04242345678" aria-describedby="telf_cel" name="telf_cel" id="telf_cel" onkeypress="return soloNumeros(event)" onchange="validaTelefono(this);" maxlength="11"/>
                        </div>
                        <div class="col">
                          <span class="form-group">Correo electrónico</span>
                          <input type="text" class="form-control" placeholder="usuario@dominio.com" aria-describedby="correo" name="correo" id="correo" onkeyup="mayusculas(this);" onchange="validateCorreo(this)"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="datosPago">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <span><h4>Datos de pago</h4></span>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Tipo de suscriptor</span>
                          <select class="form-control" name="tipoSuscriptor" id="tipoSuscriptor" >
                              <option value="" disabled selected style="display:none;">Seleccione...</option>
                              <option value="NATURAL" style="display:enable;">NATURAL</option>
                              <option value="GUBERNAMENTAL" style="display:enable;">GUBERNAMENTAL</option>
                              <option value="VIP" style="display:enable;">VIP</option>
                           </select>
                        </div>
                        <div class="col">
                          <span class="form-group">Referencia del pago</span>
                          <input type="text" class="form-control" placeholder="00012345" aria-describedby="referenciaPago" name="referenciaPago" id="referenciaPago" onkeyup="mayusculas(this);" onchange="validateCorreo(this)" maxlength="12" />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Banco o proveedor</span>
                          <select class="form-control" name="banco" id="banco" >
                          <?php foreach ($bancos as $b) { ?>
                            <option value="" disabled selected style="display:none;">Seleccione...</option>
                            <option value="<?php echo $b["id_banco"];?>" style="display:enable;"><?php echo $b["descripcion"];}?></option>
                          </select>
                        </div>
                        <div class="col">
                          <span class="form-group">Tipo de moneda</span>
                          <select class="form-control" name="tipoMoneda" id="tipoMoneda" >
                              <option value="" disabled selected style="display:none;">Seleccione...</option>
                              <option value="BOLIVAR" style="display:enable;">BOLIVAR</option>
                              <option value="DOLAR" style="display:enable;">DOLAR</option>
                           </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col">
                          <span class="form-group">Fecha del pago</span>
                          <input type="date" class="form-control"  aria-describedby="fechaPago" name="fechaPago" id="fechaPago" />
                        </div>
                        <div class="col">
                          <span class="form-group">Monto del pago</span>
                          <input type="text" class="form-control" placeholder="1.000,00" aria-describedby="montoPago" name="montoPago" id="montoPago" onkeyup="mayusculas(this);" onchange="validateCorreo(this)"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!--div id="datosTecnicos">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <span><h4>Datos técnicos</h4></span>
                    <div id="decoCliente">
                      <div class="row">
                        <div class="col">
                          <label>Serial decodificador</label>
                          <input type="text" class="form-control" name="serialDeco" id="serialDeco" placeholder="0000 0000 0000" onkeypress="return soloNumeros(event)" maxlength="12">
                        </div>
                        <div class="col">
                          <label>Serial SmartCard</label>
                          <input type="text" class="form-control" name="serialSC" placeholder="0000-0000-0000" onkeypress="return soloNumeros(event)" maxlength="12">
                        </div>
                      </div>
                      <br>       
                    </div>
                  </div>
                </div>
              </div>
            </div-->

            </div>
            <!--div id="d_cliente_no_efectivo">
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col">
                        <span class="form-group">Teléfono Celular</span>
                        <input type="text" class="form-control" placeholder="04242345678" aria-describedby="telf_cel_no" name="telf_cel_no" id="telf_cel_no" onkeypress="return soloNumeros(event)" onchange="validaTelefono(this);" maxlength="11"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div-->

            <div class="form-group col">
              <button type="submit" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Guardar</span></button>
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="modalCaso22" tabindex="-1" role="dialog" aria-labelledby="modalCaso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="tituloModal"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">     
        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <span class="form-group">Tipo de suscriptor</span>
              <input type="text" class="form-control" aria-describedby="modalTipoSuscriptor" name="modalTipoSuscriptor" id="modalTipoSuscriptor" readonly/>
            </div>
            <div class="col">
              <span class="form-group">Referencia del banco</span>
              <input type="text" class="form-control" aria-describedby="modalReferenciaPago" name="modalReferenciaPago" id="modalReferenciaPago" readonly/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <span class="form-group">Banco o proveedor</span>
              <input type="text" class="form-control" aria-describedby="modalBanco" name="modalBanco" id="modalBanco" readonly/>
            </div>
            <div class="col">
              <span class="form-group">Tipo de moneda</span>
              <input type="text" class="form-control" aria-describedby="modalTipoMoneda" name="modalTipoMoneda" id="modalTipoMoneda" readonly/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <span class="form-group">Fecha del pago</span>
              <input type="text" class="form-control" aria-describedby="modalFechaPago" name="modalFechaPago" id="modalFechaPago" readonly/>
            </div>
            <div class="col">
              <span class="form-group">Monto del pago</span>
              <input type="text" class="form-control" aria-describedby="modalMontoPago" name="modalMontoPago" id="modalMontoPago" readonly/>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>