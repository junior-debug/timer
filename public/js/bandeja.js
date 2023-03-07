$(document).ready(function(){

	$("#btn-actualizar").click(function(){
		$.ajax({
	      type:'POST',
	      url:'?view=bandeja&mode=actualizar',
	      dataType: "json",
	      data:{estatus: $("select#estatus").val(), observaciones: $("#observaciones").val(),idGestion: $("#idGestion").val(), idUsuario: $("#idUsuario").val()},
	      success:function(datos){
	        if(datos.response == "true"){
	        	$('#modalActualiza').modal('hide');
            	$('#modalConfirm').modal('toggle');
            	setTimeout(function(){ $('#modalConfirm').modal('show') }, 1000);
            	setTimeout(function(){$(location).attr('href','?view=bandeja&mode=index')}, 2000);
	      	}else{
	      		alert("Error")
	      	}
	      }
	    });
	}) //CIERRE DE EVENTO CLICK

});