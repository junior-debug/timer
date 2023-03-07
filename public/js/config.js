$(document).ready(function(){
	$('#btn-ingresarPosiciones').click(function(){ 
		var cant_posicion 		= $('#cant_posicion_').val();
		var servicio_posicion 	= $('#servicio_posicion_').val();
		var mes_posicion 		= $('#mes_').val();
		var anio_posicion 		= $('#anio_').val();
		
		if ( cant_posicion == 0 || cant_posicion == "" || cant_posicion == null || cant_posicion ==undefined) {
			alert('Debe ingresar la cantidad de posiciones')
		}else{
			$.ajax({
				type:'POST',
				url:'?view=config&mode=validarPosiciones',
				dataType: "json",
				data:{servicio_:servicio_posicion, mes_:mes_posicion , anio_:anio_posicion },
				success:function(datos){
					if (datos.response == 'true') {
						alert( 'Ya se ingreso posiciones para el servicio seleccionado para el mes y año actual')
						return false
					
					}else{
						//return false
						document.forms["form_posiciones_"].submit();
					}
				}
			})
		}
	});
});

function selectOnchangePosicion_(e){ 
	var partes_ = e.split('?/?');
	$('#name_servicio').val(partes_[1]);

	$.ajax({
		type:'POST',
		url:'?view=usuarios&mode=selectCampanas',
		//dataType: "json",
		data:{id_servicio: partes_[0]},
		success:function(datos){
		    $('#bloqueCampanaPosici').html(datos)
		}
	})
}

function editarPosicionMes(e){
	$('#valorPosicionMes_').val(e)

	$.ajax({
		type:'POST',
		url:'?view=config&mode=editarPosiciones',
		dataType: "json",
		data:{ idPM:e },
		success:function(datos){
			if (datos.response == 'true') {
				$('#cant_posicionEdit_').val(datos.posiciones_);
				$('#servicioEdit_').val(datos.servicios_);
				$('#mesEdit_').val(datos.mess_);
				$('#anioEdit_').val(datos.years_);
				$('#modalEditPM').modal("show")	
				return false
					
			}else{
				$('#cant_posicionEdit_').val("");
				$('#servicioEdit_').val("");
				$('#mesEdit_').val("");
				$('#anioEdit_').val("");
				$('#modalEditPM').modal("hidden")	
				return false
				
			}
		}
	})
}
function NoEditPM(){ 
	$('#cant_posicionEdit_').val("");
	$('#servicioEdit_').val("");
	$('#mesEdit_').val("");
	$('#anioEdit_').val("");
	$('#modalEditPM').modal("hide")
}

function SiEditPM(){
	var valorPosicionMes_ 	= $('#valorPosicionMes_').val();
	var cant_posicionEdit_ 	= $('#cant_posicionEdit_').val();
	
	if (cant_posicionEdit_ == null || cant_posicionEdit_ == "" || cant_posicionEdit_ == 0 ) {
		alert('Existen campos vacios')
	}else{
		$.ajax({
		type:'POST',
		url:'?view=config&mode=SiEditarPosiciones',
		//dataType: "json",
		data:{ idPM:valorPosicionMes_, cantidad:cant_posicionEdit_ },
		success:function(datos){
			alert('Cambio exitoso')
			var url="?view=config&mode=posicion_mes";
        	window.location=url;

			/*alert(datos)
			if (datos.response == 'true') {
				alert('Cambio exitoso')
				var url="?view=config&mode=posicion_mes";
        		window.location=url;
			}*/
		}
	})		
	}

 
}

function deleteePosicionMes(e){ 
	//alert(e)
	$('#valor_PosicionMes_').val(e)
}
function NoBorrarPM(e){ 
    $('#valor_PosicionMes_').val("");
}
function SiBorrarPM(e){ 
    $.post("?view=config&mode=siBorrarPM",{idPM: $('#valor_PosicionMes_').val()},function(r){    
        /*alert(r);*/
        alert('Cambio exitoso')
        var url="?view=config&mode=posicion_mes";
        window.location=url;
    })
}
