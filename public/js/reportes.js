/*$(document).ready(function(){
	$('#busquedaAgent').click(function(){
    	$.ajax({
	        type:'POST',
	        url:'?view=reportes&mode=registroCronometroFIN',
	       // dataType: "json",
	        data:{time:time_fin, time_Bre:time_Bre_fin, time_Entr:time_Entr_fin, time_FBack:time_FBack_fin, time_Bano:time_Bano_fin, time_LLSa:time_LLSa_fin, idUsuario: $('#idUsuario').val()},
	        success:function(datos){
	        	//alert(datos)
	        	window.location="?view=session&mode=disconect";
	        }
	    }) 
    })

});



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
}*/
