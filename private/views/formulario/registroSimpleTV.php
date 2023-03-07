<script type="text/javascript" src="public/js/formulario.js"></script>

<!-- Begin Page Content
<script type="text/javascript" src="public/js/validaciones.js"></script>
 -->
<div class="container-fluid">
   <!-- Content Row -->
      <form name="form_registroSimpleTV" id="form_registroSimpleTV" >
         <div class="row" id="">
         <div class="col col-lg-2"></div>
               <div class="col-lg-8">
                  <div class="card shadow mb-4">
                        <div class="card-body">
                           <!-- DATOS DEL CLIENTE -->
                           <input type="hidden" id="idCliente" name="idCliente">
                           <div id="d_informacion_personal">
                           <div id="datosCliente">
                                 <div class="card shadow mb-4">
                                       <div class="card-body">
                                          <span class="form-group" id="">
                                             <h4>Informacion personal</h4>
                                          </span>
                                          <div class="form-group">
                                             <div class="form-row">
                                                <div class="col">
                                                      <span class="form-group">Nombre *</span>
                                                      <input type="text" name="nombre_" id="nombre_" class="form-control" />
                                                      <p id="errorNombre" style="display: none;" class="form-group text-danger">Tu nombre es necesari</p>
                                                </div>
                                                <div class="col">
                                                      <span class="form-group">Apellido *</span>
                                                      <input type="text" name="apellido_" id="apellido_" class="form-control" />
                                                      <p id="errorApellido" style="display: none;" class="form-group text-danger">Tu apellido es necesario</p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="form-row">
                                                <div class="col">
                                                      <span class="form-group">Sexo *</span>
                                                      <select class="form-control" name="sexo_" id="sexo_">
                                                      <option selected></option>
                                                      <option value="M">Masculino</option>
                                                      <option value="F">Femenino</option>
                                                      </select>
                                                      <p id="errorSexo" style="display: none;" class="form-group text-danger">El género es requerido</p>
                                                </div>
                                                <div class="col">
                                                   <span class="form-group">Fecha de Nacimiento *</span>
                                                   <input type="date" class="form-control" name="fecha_nacim_" id="fecha_nacim_" />
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="form-row">
                                                <div class="col">
                                                      <span class="form-group">Tipo de Documento *</span>
                                                      <select class="form-control" name="type_doc_" id="type_doc_">
                                                      <option selected value="0"></option>
                                                      <option value="Venezolano">Venezolano</option>
                                                      <option value="Extranjero">Extranjero</option>
                                                      <option value="RIF">RIF</option>
                                                      <option value="Gobierno">Gobierno</option>
                                                      <option value="Pasaporte">Pasaporte</option>
                                                      </select>
                                                      <p id="errorTypeDoc" style="display: none;" class="form-group text-danger">El Tipo de Documento es necesario</p>
                                                </div>
                                                <div class="col">
                                                      <span class="form-group">Número de Documento *</span>
                                                      <input type="number" class="form-control" name="num_doc_" id="num_doc_"/>
                                                      <p id="errorNumDoc" style="display: none;" class="form-group text-danger">Tu Número de Identificación es necesario</p>
                                                </div>
                                             </div>
                                          </div>

                                          <div class="form-group">
                                             <div class="form-row">
                                                <div class="col">
                                                   <form class="form-inline">
                                                      <span class="form-group">Teléfono Fijo</span>
                                                      <div class="input-group">
                                                         <div class="input-group-prepend">
                                                            <select class="form-control" name="tlf_fijo_" id="tlf_fijo_">
                                                               <option selected></option>
                                                               <option value="212">212</option>
                                                               <option value="234">234</option>                      
                                                               <option value="235">235</option>
                                                               <option value="238">238</option>
                                                               <option value="239">239</option>                      
                                                               <option value="240">240</option>
                                                               <option value="241">241</option>
                                                               <option value="242">242</option>                      
                                                               <option value="243">243</option>
                                                               <option value="244">244</option>
                                                               <option value="245">245</option>                      
                                                               <option value="246">246</option>
                                                               <option value="247">247</option>
                                                               <option value="248">248</option>                      
                                                               <option value="249">249</option>
                                                               <option value="251">251</option>
                                                               <option value="252">252</option>                      
                                                               <option value="253">253</option>
                                                               <option value="254">254</option>
                                                               <option value="255">255</option>                      
                                                               <option value="256">256</option>
                                                               <option value="257">257</option>
                                                               <option value="258">258</option>                      
                                                               <option value="259">259</option>
                                                               <option value="261">261</option>
                                                               <option value="262">262</option>                      
                                                               <option value="263">263</option>
                                                               <option value="264">264</option>
                                                               <option value="265">265</option>                      
                                                               <option value="266">266</option>
                                                               <option value="267">267</option>
                                                               <option value="268">268</option>                      
                                                               <option value="269">269</option>
                                                               <option value="271">271</option>
                                                               <option value="272">272</option>                      
                                                               <option value="273">273</option>
                                                               <option value="274">274</option>
                                                               <option value="275">275</option>                      
                                                               <option value="276">276</option>
                                                               <option value="277">277</option>
                                                               <option value="278">278</option>                      
                                                               <option value="279">279</option>
                                                               <option value="281">281</option>
                                                               <option value="282">282</option>                      
                                                               <option value="283">283</option>
                                                               <option value="284">284</option>
                                                               <option value="285">285</option>                      
                                                               <option value="286">286</option>
                                                               <option value="287">287</option>
                                                               <option value="288">288</option>                      
                                                               <option value="289">289</option>
                                                               <option value="291">291</option>
                                                               <option value="292">292</option>                      
                                                               <option value="293">293</option>                      
                                                               <option value="294">294</option>                      
                                                               <option value="295">295</option>
                                                            </select>
                                                         </div>
                                                         <input type="number" class="form-control" name="num_fijo_" id="num_fijo_">
                                                         <p id="errorTlfFijo" style="display: none;" class="form-group text-danger">El teléfono fijo o el teléfono móvil es necesario</p>
                                                      </div>
                                                   </form>
                                                </div>
                                                <div class="col">
                                                   <form class="">
                                                      <span class="form-group">Celular</span>
                                                      <div class="input-group">
                                                         <div class="input-group-prepend">
                                                            <select class="form-control" name="celular_" id="celular_">
                                                               <option selected></option>
                                                               <option value="412">412</option>
                                                               <option value="424">424</option>                      
                                                               <option value="414">414</option>
                                                               <option value="426">426</option>
                                                               <option value="416">416</option>
                                                            </select>
                                                         </div>
                                                         <input type="number" class="form-control" name="num_celular_" id="num_celular_">
                                                         <p id="errorCelular" style="display: none;" class="form-group text-danger">El teléfono fijo o el teléfono móvil es necesario</p>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>

                                    <div class="form-group">
                                          <div class="form-row">
                                          <div class="col">
                                             <span class="form-group">Instagram</span>
                                             <input type="text" class="form-control" name="redsocial1_" id="redsocial1_" />
                                          </div>
                                          <div class="col">
                                             <span class="form-group">Twitter</span>
                                             <input type="text" class="form-control" name="redsocial2_" id="redsocial2_" />
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div id="inform_cuente">
                           <div class="card shadow mb-4">
                              <div class="card-body">
                                 <span><h4>Información de cuenta</h4></span>
                                 <div class="form-group">
                                    <div class="form-row">
                                       <div class="col">
                                          <span class="form-group">Correo Electrónico *</span>
                                          <input type="mail" class="form-control" name="email_" id="email_"/>
                                          <p id="errorEmail" style="display: none;" class="form-group text-danger">Por favor escribe tu correo electrónico</p>
                                       </div>
                                       <div class="col">
                                          <span class="form-group">Confirmar correo electrónico *</span>
                                          <input type="mail" class="form-control" name="confirm_email_" id="confirm_email_"/>
                                          <p id="errorConfEmail" style="display: none;" class="form-group text-danger">Confirma tu correo electrónico</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                          <div class="form-row">
                                          <div class="col">
                                             <span class="form-group">Contraseña *</span>
                                             <input type="password" class="form-control" name="clave_" id="clave_" />
                                          </div>
                                          <div class="col">
                                             <span class="form-group">Confirma tu contraseña *</span>
                                             <input type="password" class="form-control" name="confirmclave_" id="confirmclave_" />
                                          </div>
                                       </div>
                                    </div>
                                 <div class="form-group">
                                    <div class="form-row">
                                       <div class="col">
                                          <span class="form-group">Estado *</span>
                                          <select class="form-control" name="estado_" id="estado_" required>
                                             <option id=""  value="0">Seleccione...</option>
                                             <?php foreach ($estados as $key ) { ?>
                                                <option value="<?php echo $key['id_estado'] ?>"><?php echo $key['estado']?> </option>
                                             <?php } ?>
                                          </select>
                                          <p id="errorEstado" style="display: none;" class="form-group text-danger">El estado es necesario</p>
                                       </div>
                                       <div class="col">
                                          <span class="form-group">Ciudad *</span>
                                          <select class="form-control" name="ciudad_" id="ciudad_"></select>
                                          <p id="errorCiudad" style="display: none;" class="form-group text-danger">La ciudad es necesario</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="form-row">
                                       <div class="col">
                                          <span class="form-group">Municipio *</span>
                                          <select class="form-control" name="municipio_" id="municipio_"></select>
                                          <p id="errorMunicipio" style="display: none;" class="form-group text-danger">El Municipio es necesario</p>
                                       </div>
                                       <div class="col">
                                          <span class="form-group">Sector *</span>
                                          <select class="form-control" name="sector_" id="sector_"></select>
                                          <p id="errorSector" style="display: none;" class="form-group text-danger">El Sector es necesario</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <span class="form-group">Dirección 1 *</span>
                                    <input type="text" class="form-control" name="direccion1_" id="direccion1_" />
                                    <p id="errorDireccion1" style="display: none;" class="form-group text-danger">La dirección 1 es necesaria</p>
                                 </div>
                                 <div class="form-group">
                                    <span class="form-group">Dirección 2</span>
                                    <input type="text" class="form-control" name="direccion2_" id="direccion2_" />
                                 </div>
                                 <div class="form-group">
                                    <div class="form-row">
                                       <div class="col">
                                          <span class="form-group">Código postal *</span>
                                          <select class="form-control" name="codigo_postal_" id="codigo_postal_"></select>
                                          <p id="errorCodigoPostal" style="display: none;" class="form-group text-danger">El Código Postal es necesario</p>
                                       </div>
                                       <div class="col"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <center><button id="botonContinuar" type="button" class="btn btn-primary">Continuar</button></center><br>
                        <!--center><span class="form-group">Ya tiene una cuenta?</span><a href=""><strong> Iniciar Sesión </strong></a></center-->
                     </div>
                  </div>
               </div>
         </div>
   </form>
</div>