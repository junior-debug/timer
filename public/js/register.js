//VALIDACIONES DE CAMPOS
$(document).ready(function () {
  $("#bloqueSuperv").hide();

  $("#botonDescargarExcell").attr({
    href: "public/archivos/FORMATO_DE_CARGA_ServiCampana_.xlsx",
  });

  $("#btn-register").click(function () {
    nombre = $("#nombre_index").val();
    apellido = $("#apellido_index").val();
    cedula = $("#cedula_index").val();
    genero = $("#genero_index").val();
    cargo = $("#cargo_index").val();
    fecha_ingreso = $("#fecha_ingreso_index").val();
    rotacion = $("#rotacion_index").val();
    turno = $("#turno_index").val();
    supervisor = $("#supervisor_index").val();
    users = $("#usernewIndex").val();
    passs = $("#pass_index").val();
    SelectRadio = $("#resultSelectRadio").val();
    //pass    = "123456";

    if (
      nombre == "" ||
      apellido == "" ||
      cedula == "" ||
      genero == null ||
      cargo == null ||
      fecha_ingreso == "" ||
      rotacion == null ||
      turno == null ||
      users == ""
    ) {
      alert("Existen campos vacios, Validar");
    } else {
      if (cargo == "OPERADOR") {
        servicio = $("#servicio_index").val();
        campana = $("#campana_index").val();
        var partes_ = servicio.split("?/?");

        if (
          supervisor == null ||
          supervisor == "" ||
          supervisor == 0 ||
          servicio == null ||
          servicio == "" ||
          servicio == 0 ||
          campana == null ||
          campana == "" ||
          campana == 0
        ) {
          alert(
            " El operador debe estar asociado a un Supervisor y/o Servicio. Revisar"
          );
          //supervisor = 0;
        } else {
          /* 	alert('OPERADORRR  scripttt nombre: ' + nombre+ ' ==> apellido: '+ apellido+ ' ==> cedula: '+ cedula+ ' ==> genero: '+ genero+ ' ==> cargo: '+cargo+
		    				' ==> fecha_ingreso: '+ fecha_ingreso+ ' ==> servicio: '+  partes_[1]+ ' ==> servicio2: '+ servicio+ ' ==> turno: '+ turno + ' ==> campana: '+
		    				campana+ ' ==> rotacion: '+ rotacion+ ' ==> turno: '+ turno+ ' ==> supervisor: '+ supervisor+ ' ==> users: '+ users+	' ==> passs: '+passs)
						*/
          $.ajax({
            type: "POST",
            url: "?view=usuarios&mode=registro_empleado",
            dataType: "json",
            data: {
              nombre: nombre,
              apellido: apellido,
              cedula: cedula,
              genero: genero,
              cargo: cargo,
              fecha_ingreso: fecha_ingreso,
              servicio: partes_[1],
              campana: campana,
              rotacion: rotacion,
              turno: turno,
              supervisor: supervisor,
              users: users,
              passs: passs,
              radioSuper: 1,
            },
            success: function (datos) {
              //alert(datos)
              if (datos.response == "true") {
                alert("REGISTRO EXITOSO");
                $(location).attr("href", "?view=usuarios&mode=index");
              } else {
                alert("El usuario ya existe...");
              }
            },
          });
        }
      } else if (
        cargo == "ANALISTA" ||
        cargo == "COORDINADOR" ||
        cargo == "CLIENTE"
      ) {
        servicio = $("#servicio_index").val();
        campana = 0; //$('#campana_index').val();
        supervisor = 0;
        var partes_ = servicio.split("?/?");

        if (servicio == null || servicio == "" || servicio == 0) {
          alert("Debe estar asociado a un Servicio");
        } else {
          /*	alert('ANALISTA/COORDINADOR/CLIENTE  scripttt nombre: ' + nombre+ ' ==> apellido: '+ apellido+ ' ==> cedula: '+ cedula+ ' ==> genero: '+ genero+ ' ==> cargo: '+cargo+
	    				' ==> fecha_ingreso: '+ fecha_ingreso+ ' ==> servicio: '+ partes_[1]+ ' ==> servicio2: '+ servicio+ ' ==> turno: '+ turno + ' ==> campana: '+
	    				campana+ ' ==> rotacion: '+ rotacion+ ' ==> turno: '+ turno+ ' ==> supervisor: '+ supervisor+ ' ==> users: '+ users+	' ==> passs: '+passs)*/

          $.ajax({
            type: "POST",
            url: "?view=usuarios&mode=registro_empleado",
            dataType: "json",
            data: {
              nombre: nombre,
              apellido: apellido,
              cedula: cedula,
              genero: genero,
              cargo: cargo,
              fecha_ingreso: fecha_ingreso,
              servicio: partes_[1],
              campana: campana,
              rotacion: rotacion,
              turno: turno,
              supervisor: supervisor,
              users: users,
              passs: passs,
              radioSuper: 1,
            },
            success: function (datos) {
              //	alert(datos.response)
              if (datos.response == "true") {
                alert("REGISTRO EXITOSO");
                $(location).attr("href", "?view=usuarios&mode=index");
              } else {
                alert("El usuario ya existe...");
              }
            },
          });
        }
      } else if (cargo == "GERENTE") {
        supervisor = 0;
        /*alert('GERENTE/GERENTE/GERENTE/GERENTE ***** scripttt nombre: ' + nombre+ ' ==> apellido: '+ apellido+ ' ==> cedula: '+ cedula+ ' ==> genero: '+ genero+ ' ==> cargo: '+cargo+
	    				' ==> fecha_ingreso: '+ fecha_ingreso+ ' ==> servicio: ADMIN ' + ' ==> servicio2: ADMIN ' + ' ==> turno: ADMIN ' + ' ==> campana: ADMIN '+
	    		 	 ' ==> rotacion: ADMIN ' + ' ==> turno: ADMIN ' + ' ==> supervisor: '+ supervisor + ' ==> users: '+ users+	' ==> passs: '+passs)*/

        $.ajax({
          type: "POST",
          url: "?view=usuarios&mode=registro_empleado",
          dataType: "json",
          data: {
            nombre: nombre,
            apellido: apellido,
            cedula: cedula,
            genero: genero,
            cargo: cargo,
            fecha_ingreso: fecha_ingreso,
            servicio: "ADMIN",
            campana: "ADMIN",
            rotacion: "ADMIN",
            turno: "ADMIN",
            supervisor: supervisor,
            users: users,
            passs: passs,
            radioSuper: 1,
          },
          success: function (datos) {
            //alert(datos.response)
            if (datos.response == "true") {
              alert("REGISTRO EXITOSO");
              $(location).attr("href", "?view=usuarios&mode=index");
            } else {
              alert("El usuario ya existe...");
            }
          },
        });
      } else if (cargo == "SUPERVISOR") {
        supervisor = 0;
        if (
          SelectRadio == "" ||
          SelectRadio == 0 ||
          SelectRadio == null ||
          SelectRadio == undefined
        ) {
          alert(
            " Deben selecionar si esta asociado a un servicio o varios -_-"
          );
        } else {
          if (SelectRadio == 1) {
            // un servicio
            servicio = $("#servicio_index").val();
            campana = $("#campana_index").val();
            var partes_ = servicio.split("?/?");

            if (servicio == null || servicio == 0 || servicio == "") {
              //alert(' -_- no supervisa nada entonces -_-, paciencia')
            } else {
              /*alert( ' UNNN UNOOO servicio BIENN: '+ servicio + ' campana: '+ campana+ ' CHEVEREE ')
				    			alert('SUPERVISOR *** SUPERVISOR ***** scripttt nombre: ' + nombre+ ' ==> apellido: '+ apellido+ ' ==> cedula: '+ cedula+ ' ==> genero: '+ genero+ ' ==> cargo: '+cargo+
				    					' ==> fecha_ingreso: '+ fecha_ingreso+ ' ==> servicio: '+  partes_[1]+ ' ==> servicio2: '+ servicio+ ' ==> turno: '+ turno + ' ==> campana: '+
				    					campana+ ' ==> rotacion: '+ rotacion+ ' ==> turno: '+ turno+ ' ==> supervisor: '+ supervisor+ ' ==> users: '+ users+	' ==> passs: '+passs)
								*/
              $.ajax({
                type: "POST",
                url: "?view=usuarios&mode=registro_empleado",
                dataType: "json",
                data: {
                  nombre: nombre,
                  apellido: apellido,
                  cedula: cedula,
                  genero: genero,
                  cargo: cargo,
                  fecha_ingreso: fecha_ingreso,
                  servicio: partes_[1],
                  campana: campana,
                  rotacion: rotacion,
                  turno: turno,
                  supervisor: supervisor,
                  users: users,
                  passs: passs,
                  radioSuper: 1,
                },
                success: function (datos) {
                  //alert(datos)
                  if (datos.response == "true") {
                    alert("REGISTRO EXITOSO");
                    $(location).attr("href", "?view=usuarios&mode=index");
                  } else {
                    alert("El usuario ya existe...");
                  }
                },
              }); /**/
            }
          } else {
            // varios servicioss
            servicio = 0;
            campana = 0;
            supervisor = 0;
            var servicsArra = new Array();
            var campansArra = new Array();

            $("form .servMuch").each(function () {
              //alert(' valor de los services: ' +  $(this).val() )
              if ($(this).val() != null) {
                //alert('Vergacion sí, no supervisa ningun servicio, que de pinga')
                partes_ = $(this).val().split("?/?");
                servicsArra.push(partes_[2]);
              } else {
              }
            });

            $("form .campMuch").each(function () {
              //alert(' valor de las campañas: ' +  $(this).val() )
              if ($(this).val() != 0) {
                campansArra.push($(this).val());
              } else {
              }
            });

            if (servicsArra.length != 0) {
              valorOriginalServi = servicsArra.length;
              //unico = jQuery.unique(servicsArra);
              //valorPrueba = unico.length;

              let data = servicsArra;
              const dataArr = new Set(data);
              let result = [...dataArr];
              valorPrueba = result.length;

              console.log(dataArr);
              console.log(result);
              console.log(valorOriginalServi + " " + valorPrueba);

              if (valorOriginalServi != valorPrueba) {
                //alert('los servicios no pueden repetirse hijo de DIOSSS')
                return false;
              } else {
                if (servicsArra.length == campansArra.length) {
                  /*alert (' arreglo finall servicio: ' + servicsArra );
										alert (' arreglo finall campaña: ' + campansArra);
					              		alert(' chevere ');
					              		alert('SUPERVISOR *** SUPERVISOR *****  scripttt nombre: ' + nombre+ ' ==> apellido: '+ apellido+ ' ==> cedula: '+ cedula+ ' ==> genero: '+ genero+ ' ==> cargo: '+cargo+
											     			' ==> fecha_ingreso: '+ fecha_ingreso+ ' ==> servicio: '+ servicio+ ' ==> servicio2: '+ servicsArra+ ' ==> turno: '+ turno + ' ==> campana: '+
											     			 campansArra+ ' ==> rotacion: '+ rotacion+ ' ==> turno: '+ turno+ ' ==> supervisor: '+ supervisor+ ' ==> users: '+ users+	' ==> passs: '+passs)
										*/

                  $.ajax({
                    type: "POST",
                    url: "?view=usuarios&mode=registro_empleado",
                    dataType: "json",
                    data: {
                      nombre: nombre,
                      apellido: apellido,
                      cedula: cedula,
                      genero: genero,
                      cargo: cargo,
                      fecha_ingreso: fecha_ingreso,
                      servicio: servicsArra,
                      campana: campansArra,
                      rotacion: rotacion,
                      turno: turno,
                      supervisor: supervisor,
                      users: users,
                      passs: passs,
                      radioSuper: 2,
                    },
                    success: function (datos) {
                      //alert(datos)
                      if (datos.response == "true") {
                        alert("REGISTRO EXITOSO");
                        $(location).attr("href", "?view=usuarios&mode=index");
                      } else {
                        alert("El usuario ya existe...");
                      } /**/
                    },
                  });
                  /**/
                } else {
                  alert(
                    "Existe diferencias de cantidad entre servicios y campañas. Verificar."
                  );
                }
              }
            } else {
              alert("Seleccione Servicios");
              return false;
            }
          }
        }
      } else {
        supervisor = 0;
        alert("Error, comentarle al desarrollador!!!");
      }
    }
  });

  $("#updateEdit").click(function () {
    //OJOPOPOPOPOPOPOPOPOPOPOP, VALIDAR SI LA CEDULA A EDITAR NO SE REPITA
    var campanaEdit_ = 0;
    id_datos_empleados = $("#id_datos_empleadosEdit").val();
    nombreEdit = $("#nombreEdit").val();
    apellidoEdit = $("#apellidoEdit").val();
    cedulaEdit = $("#cedulaEdit").val();
    genero_edit = $("#genero_edit").val();
    cargoEdit = $("#cargoEdit").val();
    servicioEdit = $("#servicioEdit").val();
    campanaEdit = $("#campanaEdit").val();

    campana_index = $("#campana_index").val();
    rotacionEdit = $("#rotacionEdit").val();
    turnoEdit = $("#turnoEdit").val();

    IdCargoActualEdit = $("#IdCargoActualEdit").val();
    cargoActualEdit = $("#cargoActualEdit").val();
    cargoNuevoEdit = $("#cargoNuevoEdit").val(); // es lo mismo que cargoEdit

    //son supervisores referente cuando un supervisor cambia a otro cargo
    superviEditActual = $("#superviEditActual").val();
    supervisorEditNuevo = $("#supervisorEditNuevo").val();

    // son supervisores del registro de usuario
    supervisorEdit = $("#supervisorEdit").val();
    supervisor_index = $("#supervisor_index").val();

    servicioEdit = servicioEdit.split("?/?");
    servicioEdit = servicioEdit[1];

    if (
      campana_index == undefined ||
      campana_index == null ||
      campana_index == "0" ||
      campana_index == 0
    ) {
      campanaEdit_ = campanaEdit;
    } else if (
      campanaEdit == null ||
      campanaEdit == undefined ||
      campanaEdit == "0" ||
      campanaEdit == 0
    ) {
      campanaEdit_ = campana_index;
    } else {
    }

    //alert( campana_index + ' -->** ' + campanaEdit)

    if (supervisorEdit == null || supervisorEdit == "" || supervisorEdit == 0) {
      supervisorEdit = 0;
    } else {
      supervisorEdit = $("#supervisorEdit").val();
    }
    // alert(id_datos_empleados+ ' ==> '+ nombreEdit+ ' ==> '+apellidoEdit+ ' ==> '+cedulaEdit+ ' ==> '+ genero_edit+ ' ==> '+cargoEdit + ' ==> servicioEdit==>-* '+ servicioEdit+ ' ==> '+campanaEdit_+ ' ==> '+ rotacionEdit+ ' ==> '+ turnoEdit+ ' ==> '+ supervisorEdit+ ' ==> '+ supervisor_index + ' ==> ' + $('#valorCambioServEdit').val() + ' campana_index  ==> ' +campana_index + ' campanaEdit==> ' +campanaEdit )

    //alert( ' IdCargoActualEdit: ' + IdCargoActualEdit + ' cargoActualEdit: ' + cargoActualEdit + ' cargoEdit: ' + cargoEdit +'  cargoNuevoEdit: ' + cargoNuevoEdit +
    // ' superviEditActual: ' + superviEditActual +'  supervisorEditNuevo: ' + supervisorEditNuevo )

    if (
      nombreEdit == "" ||
      apellidoEdit == "" ||
      cedulaEdit == "" ||
      cargoEdit == "" ||
      servicioEdit == "" ||
      servicioEdit == undefined ||
      rotacionEdit == "" ||
      turnoEdit == ""
    ) {
      alert("Campos vacíos. Revisar.");
    } else {
      if (cargoActualEdit == "SUPERVISOR") {
        if (
          campanaEdit_ == undefined ||
          campanaEdit_ == null ||
          campanaEdit_ == "0" ||
          campanaEdit_ == 0
        ) {
          alert("Campos vacíos. Revisar.");
        } else {
          if (cargoActualEdit != cargoEdit) {
            if (supervisorEditNuevo != 0) {
              /*  alert( 'UPDATE datos_empleados SET supervisor =' + supervisorEditNuevo + ' WHERE supervisor =' + IdCargoActualEdit )

								alert(' de supervi cambio ' + id_datos_empleados+ ' ==> '+ nombreEdit+ ' ==> '+apellidoEdit+ ' ==> '+cedulaEdit+ ' ==> '+ genero_edit+ ' ==> '+cargoEdit
								+  ' ==> '+ servicioEdit+ ' ==> '+campanaEdit_+ ' ==> '+ rotacionEdit+ ' ==> '+ turnoEdit+ ' ==> '+ supervisorEdit+ ' ==> '+ supervisorEditNuevo + 
								' ==> ' + $('#valorCambioServEdit').val() )
								// valor: 2  HAY CAMBIO DE SUPERVISOR       valor: 1 NO HAY CAMBIO DE SUPERVISOR  */

              $.ajax({
                type: "POST",
                url: "?view=usuarios&mode=updateEdit",
                dataType: "json",
                data: {
                  id_datos_empleados: id_datos_empleados,
                  nombreEdit: nombreEdit,
                  apellidoEdit: apellidoEdit,
                  cedulaEdit: cedulaEdit,
                  genero_edit: genero_edit,
                  cargoEdit: cargoEdit,
                  servicioEdit: servicioEdit,
                  campanaEdit_: campanaEdit_,
                  rotacionEdit: rotacionEdit,
                  turnoEdit: turnoEdit,
                  supervisorEdit: supervisorEdit,
                  valorEdit: 2,
                  supervisorEditNuevo: supervisorEditNuevo,
                  IdCargoActualEdit: IdCargoActualEdit,
                },
                success: function (datos) {
                  //alert(datos.response)
                  if (datos.response == "true") {
                    alert("USUARIO ACTUALIZADO");
                    $(location).attr("href", "?view=usuarios&mode=index");
                  } else {
                    alert("ERROR");
                  }
                },
              }); /**/
            } else {
              alert(
                "hubo cambio de cargo, por favor seleccionar el nuevo supervisor, de lo contrario no guardará NADA"
              );
            }
          } else {
            /*alert(' es supervi, pero no cambio ' + id_datos_empleados+ ' ==> '+ nombreEdit+ ' ==> '+apellidoEdit+ ' ==> '+cedulaEdit+ ' ==> '+ genero_edit+ ' ==> '+cargoEdit
								+  ' ==> '+ servicioEdit+ ' ==> '+campanaEdit_+ ' ==> '+ rotacionEdit+ ' ==> '+ turnoEdit+ ' ==> '+ supervisorEdit+ ' ==> '+ supervisorEditNuevo + 
								' ==> ' + $('#valorCambioServEdit').val() )   */
            $.ajax({
              type: "POST",
              url: "?view=usuarios&mode=updateEdit",
              dataType: "json",
              data: {
                id_datos_empleados: id_datos_empleados,
                nombreEdit: nombreEdit,
                apellidoEdit: apellidoEdit,
                cedulaEdit: cedulaEdit,
                genero_edit: genero_edit,
                cargoEdit: cargoEdit,
                servicioEdit: servicioEdit,
                campanaEdit_: campanaEdit_,
                rotacionEdit: rotacionEdit,
                turnoEdit: turnoEdit,
                supervisorEdit: supervisorEdit,
                valorEdit: 1,
                supervisorEditNuevo: 0,
                IdCargoActualEdit: IdCargoActualEdit,
              },
              success: function (datos) {
                //alert(datos.response)
                if (datos.response == "true") {
                  alert("USUARIO ACTUALIZADO");
                  $(location).attr("href", "?view=usuarios&mode=index");
                } else {
                  alert("ERROR");
                }
              },
            }); /**/
          }
        }
      } else {
        /* alert(' NO es supervisor, otro cargo ' + id_datos_empleados+ ' ==> '+ nombreEdit+ ' ==> '+apellidoEdit+ ' ==> '+cedulaEdit+ ' ==> '+ genero_edit+ ' ==> '+cargoEdit
								+  ' ==> '+ servicioEdit+ ' ==> '+campanaEdit_+ ' ==> '+ rotacionEdit+ ' ==> '+ turnoEdit+ ' ==> '+ supervisorEdit+ ' ==> '+ supervisorEditNuevo + 
								' ==> ' + $('#valorCambioServEdit').val() )  */
        $.ajax({
          type: "POST",
          url: "?view=usuarios&mode=updateEdit",
          dataType: "json",
          data: {
            id_datos_empleados: id_datos_empleados,
            nombreEdit: nombreEdit,
            apellidoEdit: apellidoEdit,
            cedulaEdit: cedulaEdit,
            genero_edit: genero_edit,
            cargoEdit: cargoEdit,
            servicioEdit: servicioEdit,
            campanaEdit_: campanaEdit_,
            rotacionEdit: rotacionEdit,
            turnoEdit: turnoEdit,
            supervisorEdit: supervisorEdit,
            valorEdit: 1,
            supervisorEditNuevo: 0,
            IdCargoActualEdit: IdCargoActualEdit,
          },
          success: function (datos) {
            /alert(datos.response)/;
            if (datos.response == "true") {
              alert("USUARIO ACTUALIZADO");
              $(location).attr("href", "?view=usuarios&mode=index");
            } else {
              alert("ERROR");
            }
          },
        }); /**/
      }
    } /**/
  });

  $("#updateEditReincorpo").click(function () {
    id_datos_empleados = $("#id_datos_empleadosEdit").val();
    nombreEdit = $("#nombreEdit").val();
    apellidoEdit = $("#apellidoEdit").val();
    cedulaEdit = $("#cedulaEdit").val();
    genero_edit = $("#genero_edit").val();
    cargoEdit = $("#cargoEdit").val();
    fechaIngreEdit = $("#fechaIngreEdit").val();
    servicioEdit = $("#servicioEdit").val();
    campanaEdit = $("#campanaEdit").val();

    campana_index = $("#campana_index").val();
    rotacionEdit = $("#rotacionEdit").val();
    turnoEdit = $("#turnoEdit").val();
    usersEdit = $("#usersEdit").val();

    supervisorEdit = $("#supervisorEdit").val();

    servicioEdit = servicioEdit.split("?/?");
    servicioEdit = servicioEdit[1];

    if (campana_index == undefined) {
      campanaEdit_ = campanaEdit;
    }

    if (campanaEdit == null) {
      campanaEdit_ = campana_index;
    }

    if (supervisorEdit == null || supervisorEdit == "" || supervisorEdit == 0) {
      supervisorEdit = 0;
    } else {
      supervisorEdit = $("#supervisorEdit").val();
    }

    if (
      nombreEdit == "" ||
      apellidoEdit == "" ||
      cedulaEdit == "" ||
      cargoEdit == "" ||
      servicioEdit == "" ||
      rotacionEdit == "" ||
      turnoEdit == ""
    ) {
      alert("Campos vacíos. Revisar.");
    } else {
      //alert(id_datos_empleados+ ' ==> '+ nombreEdit+ ' ==> '+apellidoEdit+ ' ==> '+cedulaEdit+ ' ==> '+ genero_edit
      //	+ ' ==> '+cargoEdit+ ' ==> '+fechaIngreEdit +  ' ==> '+ servicioEdit+ ' ==> '+campanaEdit_+ ' ==> '+ rotacionEdit
      //	+ ' ==> '+ turnoEdit+ ' ==> '+ supervisorEdit+ ' ==> '+ usersEdit)

      $.ajax({
        type: "POST",
        url: "?view=usuarios&mode=updateEditReincorpo",
        dataType: "json",
        data: {
          id_datos_empleados: id_datos_empleados,
          nombreEdit: nombreEdit,
          apellidoEdit: apellidoEdit,
          cedulaEdit: cedulaEdit,
          genero_edit: genero_edit,
          cargoEdit: cargoEdit,
          fechaIngreEdit,
          servicioEdit: servicioEdit,
          campanaEdit_: campanaEdit_,
          rotacionEdit: rotacionEdit,
          turnoEdit: turnoEdit,
          supervisorEdit: supervisorEdit,
          usersEdit: usersEdit,
        },

        success: function (datos) {
          /*alert(datos.response)*/
          if (datos.response == "true") {
            alert("USUARIO ACTUALIZADO");
            $(location).attr("href", "?view=usuarios&mode=index");
          } else {
            alert("ERROR");
          }
        },
      }); /**/
    }
  });

  $("#btn-DeleteUser").click(function () {
    //alert($('#razonDelete').val() + ' ==> '+ $('#observacionesDelete').val() + ' ==> '+ $('#id_datos_empleadosDelete').val())
    if (
      $("#razonDelete").val() == null ||
      $("#razonDelete").val() == "" ||
      $("#observacionesDelete").val() == ""
    ) {
      alert("Campos vacios. Revisar");
    } else {
      aa = $("#id_datos_empleadosDelete").val();
      bb = $("#razonDelete").val();
      cc = $("#observacionesDelete").val();

      $.ajax({
        type: "POST",
        url: "?view=usuarios&mode=registroDeleteUser",
        dataType: "json",
        data: { id: aa, razon: bb, observacion: cc },
        success: function (datos) {
          if (datos.response == "true") {
            alert("USUARIO EGRESADO");
            $(location).attr("href", "?view=usuarios&mode=index");
          } else {
            alert("ERROR");
          } /**/
        },
      });
    }
  });

  $("#btn-UpdatePasswordUser").click(function () {
    aa = $("#id_datos_empleadosDelete_passw").val();
    //alert( ' ajax '+ aa)
    $.ajax({
      type: "POST",
      url: "?view=usuarios&mode=UpdatePaswwordUser",
      dataType: "json",
      data: { id: aa },
      success: function (datos) {
        if (datos.response == "true") {
          alert("CAMBIO EXITOSO");
          $(location).attr("href", "?view=usuarios&mode=index"); /**/
        } else {
          alert("ERROR");
        }
      },
    });
  });

  $("#btn_registerPassword").click(function () {
    var clave1 = $("#pass_CambioUno").val();
    var clave2 = $("#pass_CambioDos").val();
    var users_ = $("#idUsuarioPassword").val();
    //alert( clave1 + ' --> '+ clave2)
    if (clave1 == clave2) {
      $.ajax({
        type: "POST",
        url: "?view=usuarios&mode=resertClaveUser",
        dataType: "json",
        data: { clave1: clave1, users: users_ },
        success: function (datos) {
          /*alert(datos)*/
          if (datos.response == "true") {
            alert("REGISTRO EXITOSO");
            $(location).attr("href", "?view=session&mode=disconect_passwords_");
          } else {
            alert("Error al cambio de clave...");
          }
        },
      }); /**/
    } else {
      alert("ambas claves no coinciden!!!.");
    }
  });
});

function validar_clave_(clave /*,$error_clave*/) {
  if (clave.length < 6) {
    //$('#pass_CambioDos').attr('disabled', 'disabled')
    $("#list1").css("color", "red");
    $("#list1_").val("");
    //alert("La clave debe tener al menos 6 caracteres");
  } else {
    $("#list1").css("color", "#000");
    $("#list1_").val(12);
  }

  if (clave.length > 16) {
    //$('#pass_CambioDos').attr('disabled', 'disabled')
    $("#list2").css("color", "red");
    $("#list2_").val("");
  } else {
    $("#list2").css("color", "#000");
    $("#list2_").val(12);
  }

  if (clave.match(/[a-z]/)) {
    $("#list3").css("color", "#000");
    $("#list3_").val(12);
  } else {
    //$('#pass_CambioDos').attr('disabled', 'disabled')
    $("#list3").css("color", "red");
    $("#list3_").val("");
  }

  if (clave.match(/[A-Z]/)) {
    $("#list4").css("color", "#000");
    $("#list4_").val(12);
  } else {
    //$('#pass_CambioDos').attr('disabled', 'disabled')
    $("#list4").css("color", "red");
    $("#list4_").val("");
  }

  if (clave.match(/[0-9]/)) {
    $("#list5").css("color", "#000");
    $("#list5_").val(12);
  } else {
    //$('#pass_CambioDos').attr('disabled', 'disabled')
    $("#list5").css("color", "red");
    $("#list5_").val("");
  }
  if (
    $("#list1_").val() == 12 &&
    $("#list2_").val() == 12 &&
    $("#list3_").val() == 12 &&
    $("#list4_").val() == 12 &&
    $("#list5_").val() == 12
  ) {
    $("#pass_CambioDos").removeAttr("disabled", "disabled");
  } else {
    $("#pass_CambioDos").attr("disabled", "disabled");
  }
}

function button_modalUpdatePasswor(e) {
  //alert(e)
  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=datosUser",
    dataType: "json",
    data: { idUser: e },
    success: function (datos) {
      if (datos.response == "true") {
        $("#id_datos_empleadosDelete_passw").val(datos.id);
        $("#nombreUser_passw").val(datos.nombre);
        $("#apellidoUser_passw").val(datos.apellido);
        $("#nombreApelliUser_passw").val(datos.apellido + " " + datos.nombre);
      } else {
        alert("ERROR");
      }
    },
  });
}

function ReincorpoUser() {
  empleado = $("#IDempleados").val();
  $(location).attr(
    "href",
    "?view=usuarios&mode=FormReincorUser&id=" + empleado
  );
}
/**/
function mayus(e) {
  e.value = e.value.toUpperCase();
}
function button_modalDelete(e) {
  $("#razonDelete").val("");
  $("#observacionesDelete").val("");
  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=datosUser",
    dataType: "json",
    data: { idUser: e },
    success: function (datos) {
      if (datos.response == "true") {
        $("#id_datos_empleadosDelete").val(datos.id);
        $("#nombreUser").val(datos.nombre);
        $("#apellidoUser").val(datos.apellido);
        $("#nombreApelliUser").val(datos.apellido + " " + datos.nombre);
      } else {
        alert("ERROR");
      }
    },
  });
}
function button_modalActivarUserEgresado(e) {
  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=datosUserEgresados",
    dataType: "json",
    data: { idUser: e },
    success: function (datos) {
      if (datos.response == "true") {
        $("#IDempleados").val(datos.id);
        $("#nombreUser").val(datos.nombre);
        $("#apellidoUser").val(datos.apellido);
        $("#nombreApelliUser").val(datos.apellido + " " + datos.nombre);
      } else {
        alert("ERROR");
      }
    },
  });
}

function selectOnchange(e) {
  var partes_ = e.split("?/?");
  $("#name_servicio").val(partes_[1]);

  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=selectCampanas",
    dataType: "json",
    data: { id_servicio: partes_[0], nombreService: $("#name_servicio").val() },
    success: function (datos) {
      //alert(datos)
      $("#bloqueCampana").html(datos.blockCampana);
      $("#bloqueSupervisor").html(datos.blockSuperviServi);
    },
  });
}

function myFunctionCedula(e) {
  var evnt = e;
  /*if ( $('#apellido_index').val() == "" || $('#apellido_index').val() == 0 ) {
    	alert('Ingrese primero el apellido.') 
    	$("#usernewIndex").val("");
    	$('#cedula_index').val("")

    }else{
    	apellidos 	= $('#apellido_index').val();
    	procesado 	= apellidos.trim()
	   
	    var partess = procesado.split(' ');
		var users = partess[0]+evnt
      	$("#usernewIndex").val(users);
    }*/
  var users = evnt;
  $("#usernewIndex").val(users);
}

function cheboxServe(e) {
  //alert(' chebox ' +e)

  $("form .servMuch").each(function () {
    this.selectedIndex = 0;
  });
  $("form .campMuch").each(function () {
    this.selectedIndex = 0;
  });
  $("#resultSelectRadio").val("");
  $("#agregarBloque").val("");

  if (e == "cheboxS1") {
    //  variosServiceUNOOOOOOO
    //alert(' cheboxS1 ');
    $("#resultSelectRadio").val(1);
    $("#cuadroVariosServicios").hide();
    $("#servicio_index").val("");
    $("#campana_index").val(""); //esto es de un servicio
    $("#servicio_index").removeAttr("disabled", "disabled");
    $("#cuadroUnServicios").show();
    $("#div_bloqueCampana").show();
  } else {
    //  variosServiceMUUUUCHOOOOSS
    //alert(' cheboxS2 ');
    $("#resultSelectRadio").val(2);
    $("#servicio_index").val("");
    $("#campana_index").val("");

    $("#cuadroUnServicios").hide();
    $(".servMuch").removeAttr("disabled", "disabled");
    $("#cuadroVariosServicios").show();
  }
}

function selectCargo(e) {
  //alert(e)
  if (e == "SUPERVISOR") {
    //alert('oculta campo de supervisor');
    $("input[type=radio]").prop("checked", false);
    $("#cuadroUnServicios").hide();
    $("#cuadroVariosServicios").hide();
    $("#bloqueSuperv").hide();
    $("#supervisor_index").val("");
    $("#supervisor_index").attr("disabled", "disabled");
    $("#bloque_cheboxServicio").show();
    //$('#div_bloqueServicio').show();

    //$('#div_bloqueCampana').show();
  } else if (e == "ANALISTA") {
    //alert('oculta campo de supervisor');
    $("#bloqueSuperv").hide();
    $("#supervisor_index").val("");
    $("#supervisor_index").attr("disabled", "disabled");
    $("#bloque_cheboxServicio").hide();
    $("#div_bloqueCampana").hide();

    $("#cuadroVariosServicios").hide();
    $("#servicio_index").val("");
    $("#campana_index").val("");
    $("#servicio_index").removeAttr("disabled", "disabled");
    $("#cuadroUnServicios").show();
  } else if (e == "COORDINADOR" || e == "CLIENTE") {
    $("#bloque_cheboxServicio").hide();

    $("#bloqueSuperv").hide();
    $("#supervisor_index").val("");
    $("#supervisor_index").attr("disabled", "disabled");

    $("#cuadroVariosServicios").hide();
    $("#div_bloqueCampana").hide();

    $("#servicio_index").val("");
    $("#campana_index").val("");
    $("#servicio_index").removeAttr("disabled", "disabled");
    $("#cuadroUnServicios").show();
  } else if (e == "GERENTE") {
    $("#bloque_cheboxServicio").hide();
    $("#bloqueSuperv").hide();
    $("#supervisor_index").val("");
    $("#supervisor_index").attr("disabled", "disabled");
    $("#cuadroUnServicios").hide();
    $("#cuadroVariosServicios").hide();
    $("#servicio_index").val("");
    $("#campana_index").val("");
  } else {
    $("#bloque_cheboxServicio").hide();

    $("#cuadroVariosServicios").hide();
    $("#servicio_index").val("");
    $("#campana_index").val("");
    $("#supervisor_index").removeAttr("disabled", "disabled");
    $("#servicio_index").removeAttr("disabled", "disabled");
    $("#cuadroUnServicios").show();
    $("#div_bloqueCampana").show();
    $("#bloqueSuperv").show();
  }
}

function selectOnchangeServV(e) {
  //alert( 'selectOnchangeServV: ' + e)

  var partes_ = e.split("?/?");
  var partes_ = e.split("?/?");
  $("#name_servicio").val(partes_[2]);

  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=selectCampanasM",
    //dataType: "json",
    data: { id_servicio: partes_[1] },
    success: function (datos) {
      $("#bloqueCampanaM" + partes_[0]).html(datos);
    },
  }); /**/
}

function selectOnchangeEdit_(e) {
  var partes_ = e.split("?/?");
  var servicioInicio = $("#servicioInicioEdit").val();
  var servicioCambio = partes_[1];
  $("#name_servicioEdit").val(partes_[1]);

  //alert(' servicio actual: '+ servicioInicio + ' servicio NUEVO: ' + servicioCambio)
  //alert(' parte0: ' + partes_[0] + ' parte1: ' + partes_[1] + ' servicioInicio: ' + servicioInicio + ' servicioCambio: ' +servicioCambio + ' ' + $('#name_servicioEdit').val() )

  /*if ( servicioInicio != servicioCambio) {
		$('#valorCambioServEdit').val(2);  // 2: hubo cambio de servicio
		if ( $('#cargoEdit').val() == 'OPERADOR' ) {
				$("#campanaEdit option[value=0]").attr("selected",true);
				$("#supervisorEdit option[value=0]").attr("selected",true);
				$('#supervisorEdit').hide();
				$('#campanaEdit').hide();
				$('#bloqueCampanaEdit').show();
				$('#bloqueSupervisorEdit').show();

		}else{
				$('#bloqueCampanaEdit').hide();
				$('#bloqueSupervisorEdit').hide();
		}
		

	}else{  
		$('#valorCambioServEdit').val(1); // 1: NO hubo cambio de servicio

	}*/

  if ($("#cargoEdit").val() == "OPERADOR") {
    if (servicioInicio != servicioCambio) {
      $("#valorCambioServEdit").val(2);
      $("#campanaEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit").hide();
      $("#campanaEdit").hide();
      $("#bloqueCampanaEdit").show();
      $("#bloqueSupervisorEdit").show();
    } else {
      $("#valorCambioServEdit").val(1);
      $("#bloqueCampanaEdit").hide();
      $("#bloqueSupervisorEdit").hide();
      $("#campanaEdit").show();
      $("#supervisorEdit").show();
    }
  } else if ($("#cargoEdit").val() == "OPERADOR") {
    if (servicioInicio != servicioCambio) {
      $("#valorCambioServEdit").val(2);
      $("#campanaEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit").hide();
      $("#campanaEdit").hide();
      $("#bloqueSupervisorEdit").hide();
      $("#bloqueCampanaEdit").show();
    } else {
      $("#valorCambioServEdit").val(1);
      $("#campanaEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit").hide();
      $("#bloqueCampanaEdit").hide();
      $("#bloqueSupervisorEdit").hide();
      $("#campanaEdit").show();
    }
  } else {
    if (servicioInicio != servicioCambio) {
      $("#valorCambioServEdit").val(2);
      $("#campanaEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit").hide();
      $("#campanaEdit").hide();
      $("#bloqueSupervisorEdit").hide();
      $("#bloqueCampanaEdit").show();
    } else {
      $("#valorCambioServEdit").val(1);
      $("#campanaEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit option[value=0]").attr("selected", true);
      $("#supervisorEdit").hide();
      $("#bloqueCampanaEdit").hide();
      $("#bloqueSupervisorEdit").hide();
      $("#campanaEdit").show();
    }
  }

  /*if ( servicioInicio != servicioCambio) {
		$('#valorCambioServEdit').val(2);  // 2: hubo cambio de servicio
		$("#campanaEdit option[value=0]").attr("selected",true);
		$("#supervisorEdit option[value=0]").attr("selected",true);
		$('#supervisorEdit').hide();
		$('#campanaEdit').hide();
		$('#bloqueCampanaEdit').show();

		if ( $('#cargoEdit').val() == 'SUPERVISOR' ) {
			$('#supervisorEditt').hide();
			$('#bloqueSupervisorEdit').hide();
		}else{
			$('#supervisorEditt').show();
			$('#bloqueSupervisorEdit').show();
		}
		

	}else{
		$('#valorCambioServEdit').val(1);
		$('#bloqueCampanaEdit').hide();
		$('#bloqueSupervisorEdit').hide();
		$('#campanaEdit').show();
		$('#supervisorEdit').show();
	}*/

  $.ajax({
    type: "POST",
    url: "?view=usuarios&mode=selectCampanas",
    dataType: "json",
    data: {
      id_servicio: partes_[0],
      nombreService: $("#name_servicioEdit").val(),
    },
    success: function (datos) {
      //alert(datos.blockSuperviServi)
      $("#bloqueCampanaEdit").html(datos.blockCampana);
      $("#bloqueSupervisorEdit").html(datos.blockSuperviServi);
    },
  });
}

function selectCargoEdit(e) {
  var cargoActual = $("#cargoActualEdit").val();
  var cargoNuevo = e;
  $("#cargoNuevoEdit").val(e);

  $("#servicioEdit option[value=0]").attr("selected", true);
  $("#campanaEdit option[value=0]").attr("selected", true);
  $("#supervisorEdit option[value=0]").attr("selected", true);
  $("#campana_index option[value=0]").attr("selected", true);
  $("#supervisor_index option[value=0]").attr("selected", true);

  //alert(' cargo actual: '+ cargoActual + ' cargo NUEVO: ' +e)

  //____PARTE(1)
  if (e == "SUPERVISOR" || e == "ANALISTA") {
    $("#bloqueSupervReincor").hide();
    $("#supervisorEdit").val("");
    $("#supervisorEdit").attr("disabled", "disabled");
  } else if (e == "COORDINADOR" || e == "CLIENTE" || e == "GERENTE") {
    $("#bloqueSupervReincor").hide();
    $("#supervisorEdit").val("");
    $("#supervisorEdit").attr("disabled", "disabled");
  } else {
    $("#bloqueSupervReincor").show();
    $("#supervisorEdit").show();
    $("#supervisorEdit").removeAttr("disabled", "disabled");
  }

  //____PARTE(2)
  if (cargoActual == cargoNuevo) {
    alert("-_- esta seleccionando el mismo cargo " + cargoActual);
    $("#supervisorEditNuevo option[value=0]").attr("selected", true);
    $("#bloqueCambioSuperv").hide();
    $("#valorCambioCargoEdit").val(1);

    /*if ( cargoActual == 'OPERADOR') {
					$('#campanaEdit').hide();
					$('#supervisorEdit').hide();
					$('#bloqueCampanaEdit').show();
					$('#bloqueSupervisorEdit').show();

			}else{
					$("#supervisorEditNuevo option[value=0]").attr("selected",true);
					$('#bloqueCambioSuperv').hide();
			}*/
  } else {
    $("#valorCambioCargoEdit").val(2);
    if (cargoActual == "SUPERVISOR") {
      $("#bloqueCambioSuperv").show();
    } else {
      $("#supervisorEditNuevo option[value=0]").attr("selected", true);
      $("#bloqueCambioSuperv").hide();
    }
  }

  /*
CUANDO HACES CAMBIO DE SERVICIO CUANDO ES SIMPLE TV 
EN LAS CAMPAÑAS APARECEN TODAS LAS CAMPAÑAS, 
REVISAR EL PORQUE SE MEZCLA TODO
*/
  /*if ( cargoActual == 'SUPERVISOR') {
			if ( cargoActual == cargoNuevo) {
				alert(' -_- esta seleccionando el mismo cargo ' + cargoActual)
				$('#valorCambioCargoEdit').val(1);
				$("#supervisorEditNuevo option[value=0]").attr("selected",true);
				$('#bloqueCambioSuperv').hide();

			}else{
				$('#valorCambioCargoEdit').val(2);
				$('#bloqueCambioSuperv').show();
			}
	}else{
			$("#supervisorEditNuevo option[value=0]").attr("selected",true);
			$('#bloqueCambioSuperv').hide();
	}	*/
}

function cambioSuperviEdit(e) {
  if (e == 0) {
    alert("-_- Se debe de seleccionar un supervisor nuevo");
  }
}
