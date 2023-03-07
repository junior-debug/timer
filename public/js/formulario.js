$(document).ready(function(){
	$("#formulario").hide();
	$("#d_efectivo").hide();			//Contacto efectivo Si o NO, solo aplica para TIPO->LLAMADA
	$("#d_cliente_efectivo").hide();
	$("#d_cliente_no_efectivo").hide();
	$("#d_categoria1").hide();
	$("#d_categoria2").hide();
	$("#d_categoria3").hide();
	$("#d_noefectivo").hide();
	$("#datosPago").hide();
	$("#datosTecnicos").hide();
	$("#d_tipoAtencion").hide();

	$("#btn-buscar").click(function(){
   		$.ajax({
	      type:'POST',
	      url:'?view=formulario&mode=buscarCliente',
	      dataType: "json",
	      data:{identificacion: $("#identificacion").val()},
	      success:function(datos){
	        if(datos.response == "true"){
	          //$("#nombreCliente").html('<label><strong class="text-primary"><h5>'+datos.nombre+' '+datos.apellido+'</h5></strong></label>');
	          $("#nombre").val(datos.nombre).attr("readonly","readonly");
	          $("#apellido").val(datos.apellido).attr("readonly","readonly");
	          $("#cedula").val(datos.cedula).attr("readonly","readonly");
	          $("#telf_hab").val(datos.telf_hab).attr("readonly","readonly");
	          $("#telf_cel").val(datos.telf_cel).attr("readonly","readonly");
	          $("#correo").val(datos.correo).attr("readonly","readonly");
	          $("#idCliente").val(datos.id_cliente);
	          if(datos.response2 == "true"){
		          $("#nombreCliente").html(datos.nombreCliente);
		          $("#tablaCasos").html(datos.tablaCasos);
		          $("#tituloModal").html("Caso #"+datos.id_gestion);
		          $("#modalTipoSuscriptor").val(datos.tiposuscriptor);
		          $("#modalReferenciaPago").val(datos.referenciapago);
		          $("#modalBanco").val(datos.banco);
		          $("#modalTipoMoneda").val(datos.tipomoneda);
		          $("#modalFechaPago").val(datos.fechapago);
		          $("#modalMontoPago").val(datos.montopago);
	          }else{
	          	$("#tablaCasos").html('<div class="form-group"><h5>No posee casos por inconvenientes con recargas.</h5></div>');
	          }

	      	}else{
	      		alert("Cliente nos contacta por primera vez. Recuerda registrar sus datos.")
	      	}
	      	$("#formulario").show();
	      }
	    });
   	});

	$("#tipoContacto").change(function(){
		if($("#tipoContacto").val() === "RRSS"){
			$("#d_tipoAtencion").show();
			$("#tipoAtencion").attr('required','required');
		}else{
			$("#d_tipoAtencion").hide();
			$("#tipoAtencion").removeAttr('required');
		}
		if($("#tipoContacto").val() == "CHAT" || $("#tipoContacto").val() == "CORREO" || $("#tipoContacto").val() == "RRSS"){
			$("#d_categoria1").show();
			$("#d_categoria2").show();
			$("#d_efectivo").hide();
			$("#d_noefectivo").hide();
			$("#d_cliente_efectivo").hide();
			$("#d_cliente_no_efectivo").hide();
			//----------------------------------------------
			$("#categoria1").attr('required','required').val("");
			$("#categoria2").attr('required','required').val("");
			$("#efectivo").removeAttr('required').val("");
			$("#noefectivo").removeAttr('required').val("");
			//----------------------------------------------
			$("#d_categoria2").change(function(){
				if($("#categoria2").val() == 18){
					$("#datosPago").show();
					$("select#tipoSuscriptor").attr('required','required');
					$("#referenciaPago").attr('required','required');
					$("#banco").attr('required','required');
					$("select#tipoMoneda").attr('required','required');
					$("#fechaPago").attr('required','required');
					$("#montoPago").attr('required','required');
				}else{
					$("#datosPago").hide();
					$("select#tipoSuscriptor").removeAttr('required').val("");
					$("#referenciaPago").removeAttr('required').val("");
					$("#banco").removeAttr('required').val("");
					$("select#tipoMoneda").removeAttr('required').val("");
					$("#fechaPago").removeAttr('required').val("");
					$("#montoPago").removeAttr('required').val("");
				}
				if($("#categoria2").val() == "23" || $("#categoria2").val() == "30"){
					$("#d_categoria3").show();
					$("#categoria3").attr('required','required').val("");
					$("#datosTecnicos").show();
				}else{
					$("#d_categoria3").hide();
					$("#datosTecnicos").hide();
					$("#categoria3").removeAttr('required').val("");
				}
			});			
			$("#d_cliente_efectivo").show();
		}else{ //EL TIPO DE CONTACTO ES LLAMADA
			$("#d_categoria1").hide();
			$("#d_categoria2").hide();
			$("#d_categoria3").hide();
			$("#d_noefectivo").hide();
			$("#d_efectivo").show();
			$("#tipoEfectivo").change(function(){
				if($("#tipoEfectivo").val() == "SI"){		//CONTACTO EFECTIVO SI
					$("#d_categoria1").show();
					$("#d_categoria2").show();
					$("#d_noefectivo").hide();
					$("#d_cliente_efectivo").hide();
					$("#d_cliente_no_efectivo").hide();

					$("#categoria1").attr('required','required').val("");
					$("#categoria2").attr('required','required').val("");
					$("#efectivo").removeAttr('required').val("");
					$("#noefectivo").removeAttr('required').val("");

					$("#d_categoria2").change(function(){
						if($("#categoria2").val() == 18){
							$("#datosPago").show();
							$("select#tipoSuscriptor").attr('required','required');
							$("#referenciaPago").attr('required','required');
							$("#banco").attr('required','required');
							$("select#tipoMoneda").attr('required','required');
							$("#fechaPago").attr('required','required')
							$("#montoPago").attr('required','required');
						}else{
							$("#datosPago").hide();
							$("select#tipoSuscriptor").removeAttr('required').val("");
							$("#referenciaPago").removeAttr('required').val("");
							$("#banco").removeAttr('required').val("");
							$("select#tipoMoneda").removeAttr('required').val("");
							$("#fechaPago").removeAttr('required').val("");
							$("#montoPago").removeAttr('required').val("");
						}
						if($("#categoria2").val() == "23" || $("#categoria2").val() == "30" || $("#categoria2").val() == "50"){
							$("#d_categoria3").show();
							$("#datosTecnicos").show();
						}else{
							$("#d_categoria3").hide();
							$("#datosTecnicos").hide();
						}
					});
					$("#d_cliente_efectivo").show();

				}else{										//CONTACTO EFECTIVO NO
					$("#d_cliente_efectivo").show();
					$("#d_cliente_no_efectivo").show();
					$("#d_noefectivo").show();
					$("#d_categoria1").removeAttr('required').hide();
					$("#d_categoria2").removeAttr('required').hide();
					$("#d_categoria3").removeAttr('required').hide();
				}
			})
		}
	});


	$("#categoria1").change(function(){
    id_categoria1 = $("#categoria1").val();
     $('#categoria2').empty();
    
    $.ajax({
      type:'POST',
      url:'?view=formulario&mode=categoria2',
      dataType: "json",
      data:{id_categoria1: id_categoria1},
      success:function(datos){
        if(datos.response == 'true'){
          $('#categoria2').append('<option value="">Seleccione...</option>');
            categorias2 = String(datos.categoria2);
            var res = categorias2.split("|");
            var obj = "";
            var obj_a = "";
            for (var i = 0; i < res.length - 1; i++) {
              var res_1 = res[i].split(",");
              $('#categoria2').append('<option value="' + res_1[0] + '">' + res_1[1] + '</option>')
            }
        }
        else{
          var a = 1;
        }
      }
    })
   });

	$("#categoria2").change(function(){
    id_categoria2 = $("#categoria2").val();
    $('#categoria3').empty();

	$.ajax({
      type:'POST',
      url:'?view=formulario&mode=categoria3',
      dataType: "json",
      data:{id_categoria2: id_categoria2},
      success:function(datos){
        if(datos.response == 'true'){
          $('#categoria3').append('<option value="">Seleccione...</option>');
            categorias3 = String(datos.categoria3);
            var res = categorias3.split("|");
            var obj = "";
            var obj_a = "";
	            for (var i = 0; i < res.length - 1; i++) {
	              var res_1 = res[i].split(",");
	              $('#categoria3').append('<option value="' + res_1[0] + '">' + res_1[1] + '</option>')
            	}
        	}
      	}
    	})
   	});

   	$("#btn-consultar").click(function(){
   		alert($("#btn-consultar").val())
   	})

   	$('#btn-limpiar').click(function(){
		$(location).attr('href','?view=formulario&mode=index');
	});

	//______________FormularioSimpleTV___________
	$("#estado_").change(function() {
  		id_estado_ = $("#estado_").val();
  		if (id_estado_ == 0) {
  			$("#errorEstado").show();
  			$("#estado_").val("");
  			$('#ciudad_').empty();
  		
  		}else{
  			$("#errorEstado").hide();
  			alert(id_estado_)

  			$('#ciudad_').empty();
  			$.ajax({
		    	type:'POST',
		      	url:'?view=formulario&mode=ciudad',
		      	dataType: "json",
		      	data:{id_estado_: id_estado_},
		      	success:function(datos){ 
		      		//alert(datos.response)
		        	if(datos.response == 'true'){
		          		$('#ciudad_').append('<option value="">Seleccione...</option>');
		            	ciudad_ = String(datos.ciudad_);
		            	var res = ciudad_.split("|");
		            	var obj = "";
		            	var obj_a = "";
			            for (var i = 0; i < res.length - 1; i++) {
			              var res_1 = res[i].split(",");
			              $('#ciudad_').append('<option value="' + res_1[0] + '">' + res_1[1] + '</option>')
		            	}
		        	}/**/
		      	}
		    })
  		}
	});

	$("#ciudad_").change(function() {
  		id_ciudad_ = $("#ciudad_").val();
  		if (id_ciudad_ == 0) {
  			$("#errorCiudad").show();
  			$("#ciudad_").val("");
  			$('#municipio_').empty();
  		
  		}else{
  			$("#errorCiudad").hide();
  			alert(id_ciudad_)

  			$('#municipio_').empty();
  			$.ajax({
		    	type:'POST',
		      	url:'?view=formulario&mode=municipioo',
		      	dataType: "json",
		      	data:{id_ciudad_: id_ciudad_},
		      	success:function(datos){ 
		      		//alert(datos.response)
		        	if(datos.response == 'true'){
		          		$('#municipio_').append('<option value="">Seleccione...</option>');
		            	municipio_ = String(datos.municipio_);
		            	var res = municipio_.split("|");
		            	var obj = "";
		            	var obj_a = "";
			            for (var i = 0; i < res.length - 1; i++) {
			              var res_1 = res[i].split(",");
			              $('#municipio_').append('<option value="' + res_1[0] + '">' + res_1[1] + '</option>')
		            	}
		        	}/**/
		      	}
		    })
  		}
	});

	$("#botonContinuar").click(function() {
  		nombre_ 	    =  $("#nombre_").val();
  		apellido_	    =  $("#apellido_").val();
  		sexo_ 		    =  $("#sexo_").val();
  		fecha_nacim_    =  $("#fecha_nacim_").val();
  		type_doc_ 	    =  $("#type_doc_").val();
  		num_doc_ 	    =  $("#num_doc_").val();
  		tlf_fijo_ 	    =  $("#tlf_fijo_").val();
  		num_fijo_ 	    =  $("#num_fijo_").val();
  		celular_ 	    =  $("#celular_").val();
  		num_celular_    =  $("#num_celular_").val();

  		redsocial1_		=  $("#redsocial1_").val();
		redsocial2_		=  $("#redsocial2_").val();

  		email_ 	    	=  $("#email_").val();
  		confirm_email_ 	=  $("#confirm_email_").val();
  		clave_ 	    	=  $("#clave_").val();
  		confirmclave_ 	=  $("#confirmclave_").val();

  		

  		estado_ 	    =  $("#estado_").val();
  		ciudad_ 	    =  $("#ciudad_").val();
  		municipio_ 	    =  $("#municipio_").val();
  		sector_ 	    =  $("#sector_").val();
  		direccion1_ 	=  $("#direccion1_").val();
  		direccion2_ 	=  $("#direccion2_").val();
  		codigo_postal_ 	=  $("#codigo_postal_").val();

 		if (nombre_ == "" || apellido_ == "" || sexo_ == "" || fecha_nacim_ == "" || type_doc_ == "" || num_doc_ == "" || tlf_fijo_ == "" || 
 			num_fijo_ == "" || celular_ == "" || num_celular_ == "" || email_ == "" || confirm_email_ == "" || clave_ == "" || confirmclave_ == "" ||
 			 estado_ == "" || ciudad_ == "" || municipio_ == "" || sector_ == "" || direccion1_ == "" || codigo_postal_ == "")  {
 			alert('Existen campos vacios');
 			return false;

  		}else if (email_ != confirm_email_) {
  			alert('Debe coincidir el email')
  			return false;

  		}else if (clave_ != confirmclave_) {
  			alert('Debe coincidir la clave')
  			return false;

  		}else{
  			alert('pasa')
  			$.ajax({
		    	type:'POST',
		      	url:'?view=formulario&mode=guardarFormSimpleTV',
		      	//dataType: "json",
		      	data:{nombre_:nombre_, apellido_:apellido_, sexo_:sexo_, fecha_nacim_:fecha_nacim_, type_doc_:type_doc_, 
		      		num_doc_:num_doc_, tlf_fijo_:tlf_fijo_, num_fijo_:num_fijo_, celular_:celular_, num_celular_:num_celular_,
		      		redsocial1_:redsocial1_, redsocial2_:redsocial2_, email_:email_, clave_:clave_, estado_:estado_,
		      		ciudad_:ciudad_, municipio_:municipio_, sector_:sector_, direccion1_:direccion1_, direccion2_:direccion2_,
		      		codigo_postal_:codigo_postal_},
		      	success:function(datos){ 
		      		alert(datos)
		      	}
		    })
  		}
	});


/*	





*/


});