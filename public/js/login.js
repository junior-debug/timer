$(document).ready(function(){
	$('#username').change(function(){
    	$.post('?view=session&mode=login',
          {
            user:$('#username').val()
          },
          function(respuesta){ //alert(respuesta)
          if (respuesta!=1) {
            $('#mensaje').show()
          }
          else{
            $('#mensaje').hide()
          }/**/
        })
    })

    //VALIDACION DE LA CONTRASEÑA
       $('#btn-login').click(function(){ //alert($('#password').val())
          if ($('#username').val() === "" || $('#password').val() === "" ) { 
            $('#mensaje3').show()
          }
          else{
            $('#mensaje3').hide()
            $.post('?view=session&mode=login_',
              {
                user:$('#username').val(),
                pass:$('#password').val()
              },
              function(confirm/*,tipoUsuario*/){ 
                 // alert(' aquiiiiii ' + confirm )
                 console.log(confirm)
                    if(confirm==2){
                      $('#mensaje2').show()
                    }
                    else if(confirm==99){ //CAMBIO DE CLAVE
                      window.location='?view=usuarios&mode=cambio_password'
                    }
                    else if(confirm==1){ //ADMIN / CLIENTE
                      window.location='?view=reportes&mode=conectado_time_real'
                    }
                    else if(confirm==4 || confirm == 6){ //OPERADOR  / ANALISTA
                      window.location='?view=contador&mode=index'

                    }else if(confirm==5){ //SUPERVISOR  
                      window.location='?view=usuarios&mode=index'
                    }
                    else{
                      window.location='?view=usuarios&mode=index'
                    }/**/
              })
          } 
        })
});

function mayus(e) {
  e.value = e.value.toUpperCase();
}