/*$(window).on("beforeunload", function() { 
    var time_fin 		= $('#valorTime').val();
    var time_Bre_fin 	= $('#valorTimeBreak').val();
    var time_Entr_fin 	= $('#valorTimeEntr').val();
    var time_FBack_fin 	= $('#valorTimeFBack').val();
    var time_Bano_fin 	= $('#valorTimeBano').val();
    var time_LLSa_fin 	= $('#valorTimeLLSa').val();
    	//_________________datos para la tabla2: cambio de campaña_______________________________
    var valorCampIniU 		= $('#valorCampanaIniU').val();
    var valorTimeActual 	= $('#valorTime').val();
	var valorTimeAnterior	= $('#tiempoActual').val();

	var valortimerReady	 		= $('#timerReady_').val(); 
	//alert(time_fin + ' --> '+ time_Bre_fin + ' --> '+ time_Entr_fin + ' --> '+ time_FBack_fin + ' --> '+ time_Bano_fin + ' --> '+ time_LLSa_fin)
	if ( valorTimeAnterior == "" || valorTimeAnterior == 0  || valorTimeAnterior == null) {
		if ( valortimerReady == "" || valortimerReady == 0  || valortimerReady == null) {
			valorTimeAnterior = '00:00:00';
		}else{
			valorTimeAnterior = valortimerReady;
		}
		$('#tiempoAnterior').val(valorTimeAnterior);
		$('#tiempoActual').val(valorTimeActual);
	}
	$.ajax({
		type:'POST',
		url:'?view=contador&mode=registroCronometroFIN',
		// dataType: "json",
		data:{time:time_fin, time_Bre:time_Bre_fin, time_Entr:time_Entr_fin, time_FBack:time_FBack_fin, time_Bano:time_Bano_fin, time_LLSa:time_LLSa_fin, idUsuario: $('#idUsuario').val(), campana:valorCampIniU, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual, idHistori:$('#valorIdHistoriSesion').val()},
		success:function(datos){
		    //alert(datos)
		    window.location="?view=session&mode=disconect";
		}
	})
});*/


/*
$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY
$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY
*/

$(document).ready(function(){
	//OBTENGO EL VALOR DE LA CAMPAÑA INICIAL PARA LUEGO IR GUARDANDO AL MOMENTO QUE CAMBIE DE CAMPAÑA
	varCampIni 		= $('#valorCampanaIni').val();
	valorCampIniU 	= $('#valorCampanaIniU').val(varCampIni);	
	varCampVariant	= varCampIni;
	$('#valorCampanaVariable').val(varCampVariant)
	//____________________________________________________
	var tiempo = {
		hora:    $('#h1').val(),
		minuto:  $('#m1').val(),
		segundo: $('#s1').val()
	};
	var tiempo_corriendo = null; 
    //_____BREAK____________________________
	var tiempo_Bre = {
		hora_Bre:    $('#h2').val(),
		minuto_Bre:  $('#m2').val(),
		segundo_Bre: $('#s2').val()
	};
	var tiempo_corriendo_Bre = null;
	//_____ENTRENAMIENTO____________________________
	var tiempo_Entr = {
		hora_Entr:    $('#h4').val(),
		minuto_Entr:  $('#m4').val(),
		segundo_Entr: $('#s4').val()
	};
	var tiempo_corriendo_Entr = null;
	//_____FEED BACK____________________________
	var tiempo_FBack = {
		hora_FBack:    $('#h5').val(),
		minuto_FBack:  $('#m5').val(),
		segundo_FBack: $('#s5').val()
	};
	var tiempo_corriendo_FBack = null;
	//_____BAÑO____________________________
	var tiempo_Bano = {
		hora_Bano:    $('#h3').val(),
		minuto_Bano:  $('#m3').val(),
		segundo_Bano: $('#s3').val()
	};
	var tiempo_corriendo_Bano = null;
	//_____LLAMADAS SALIENTES_______________
	var tiempo_LLSa = {
		hora_LLSa:    $('#h6').val(),
		minuto_LLSa:  $('#m6').val(),
		segundo_LLSa: $('#s6').val()
	};
	var tiempo_corriendo_LLSa = null;

    $('#valorTimeBreak').val( $('#h2').val() + ':' + $('#m2').val() + ':' + $('#s2').val() )
    $('#valorTimeEntr').val(  $('#h4').val() + ':' + $('#m4').val() + ':' + $('#s4').val() )
    $('#valorTimeFBack').val( $('#h5').val() + ':' + $('#m5').val() + ':' + $('#s5').val() )
    $('#valorTimeBano').val(  $('#h3').val() + ':' + $('#m3').val() + ':' + $('#s3').val() )
    $('#valorTimeLLSa').val(  $('#h6').val() + ':' + $('#m6').val() + ':' + $('#s6').val() ) 

	//_________________________________
    var tiempo_corriendo = null;  
    tiempo_corriendo = setInterval(function(){
        // Segundos
        tiempo.segundo++;
        if(tiempo.segundo < 10){ 
            tiempo.segundo = '0'+tiempo.segundo;
        }
        if(tiempo.segundo >= 60){ 
            tiempo.segundo = 0;
            tiempo.minuto++;
            if(tiempo.minuto < 10){ 
	            tiempo.minuto = '0'+tiempo.minuto;
	        }
        }      
        // Minutos
        if(tiempo.minuto >= 60){
            tiempo.minuto = 0;
            tiempo.hora++;
            if(tiempo.hora < 10){ 
	            tiempo.hora = '0'+tiempo.hora;
	        }
        }
        
        $("#hour").text(tiempo.hora);
        $("#minute").text(tiempo.minuto);
        $("#second").text(tiempo.segundo);
    }, 1000);
	//_________________________________	
	setInterval(function(){ 
    	var hour = tiempo.hora
    	var min =  tiempo.minuto
    	var sec = tiempo.segundo
    	var time = hour + ':' + min + ':' + sec

    	var hourBre = tiempo_Bre.hora_Bre
        var minBre =  tiempo_Bre.minuto_Bre
        var secBre = tiempo_Bre.segundo_Bre
        var time_Bre = hourBre + ':' + minBre + ':' + secBre
		
		var hourEntr = tiempo_Entr.hora_Entr
        var minEntr =  tiempo_Entr.minuto_Entr
        var secEntr = tiempo_Entr.segundo_Entr
        var time_Entr = hourEntr + ':' + minEntr + ':' + secEntr
		
		var hourFBack = tiempo_FBack.hora_FBack
        var minFBack =  tiempo_FBack.minuto_FBack
        var secFBack = tiempo_FBack.segundo_FBack
        var time_FBack = hourFBack + ':' + minFBack + ':' + secFBack

		var hourBano = tiempo_Bano.hora_Bano
        var minBano =  tiempo_Bano.minuto_Bano
        var secBano = tiempo_Bano.segundo_Bano
        var time_Bano = hourBano + ':' + minBano + ':' + secBano
		
		var hourLLSa = tiempo_LLSa.hora_LLSa
        var minLLSa =  tiempo_LLSa.minuto_LLSa
        var secLLSa = tiempo_LLSa.segundo_LLSa
        var time_LLSa = hourLLSa + ':' + minLLSa + ':' + secLLSa
        //____________________________________________________________________________
		var timerMaxBreak 		= '00:59:00';
		var timerMaxEntre 		= '01:00:00'; 
		var timerMaxBA_FB_LL 	= '00:15:00';

		//alert(hourBre +'>='+ minBre +'>='+secBre +' <-- BREAK *** LLS-->'+ hourLLSa +'>='+ minLLSa +'>='+secLLSa)

			if ( time_Bre >= timerMaxBreak) {
				$('.containerBre').css('background', 'red')
				$('.containerBre').css('border', '1px red')
				$('.containerBre').css('color', 'white')
				
				$('#valorTimeBreak').css('color', 'red')
				$('#valorTimeBreak').css('font-weight', '700')
			}

			if ( time_Entr >= timerMaxEntre) {
				$('.containerEntr').css('background', 'red')
				$('.containerEntr').css('border', '1px red')
				$('.containerEntr').css('color', 'white')
				
				$('#valorTimeEntr').css('color', 'red')
				$('#valorTimeEntr').css('font-weight', '700')
			}

			if ( time_FBack >= timerMaxBA_FB_LL) {
				$('.containerFBack').css('background', 'red')
				$('.containerFBack').css('border', '1px red')
				$('.containerFBack').css('color', 'white')
				
				$('#valorTimeFBack').css('color', 'red')
				$('#valorTimeFBack').css('font-weight', '700')
			}

			if ( time_Bano >= timerMaxBA_FB_LL) {
				$('.containerBano').css('background', 'red')
				$('.containerBano').css('border', '1px red')
				$('.containerBano').css('color', 'white')
				
				$('#valorTimeBano').css('color', 'red')
				$('#valorTimeBano').css('font-weight', '700')
			}

			if ( time_LLSa >= timerMaxBA_FB_LL) {
				$('.containerLLSa').css('background', 'red')
				$('.containerLLSa').css('border', '1px red')
				$('.containerLLSa').css('color', 'white')

				$('#valorTimeLLSa').css('color', 'red')
				$('#valorTimeLLSa').css('font-weight', '700')
			}
		/*msjTimerBR
		msjTimerEN
		msjTimerFB
		msjTimerBA
		msjTimerLL*/
		//----------------*****************************************-----------------------------
    	$('#valorTime').val(time)
    	$('#valorTimeBreak').val(time_Bre)
    	$('#valorTimeEntr').val(time_Entr)
    	$('#valorTimeFBack').val(time_FBack)
    	$('#valorTimeBano').val(time_Bano)
    	$('#valorTimeLLSa').val(time_LLSa)  	

    	var valorHistoric = $('#valorIdHistoriSesion').val()
		var valorCampIniU 		= $('#valorCampanaIniU').val();
    	var valorTimeActual 	= $('#valorTime').val();
		var valorTimeAnterior	= $('#tiempoActual').val();
		var valortimerReady	 		= $('#timerReady_').val(); 
		
		if ( valorTimeAnterior == "" || valorTimeAnterior == 0  || valorTimeAnterior == null) {
			if ( valortimerReady == "" || valortimerReady == 0  || valortimerReady == null) {
				valorTimeAnterior = '00:00:00';
			}else{
				valorTimeAnterior = valortimerReady;
			}
			$('#tiempoAnterior').val(valorTimeAnterior);
			$('#tiempoActual').val(valorTimeActual);
 
		}
		$.ajax({
	        type:'POST', 
	        url:'?view=contador&mode=registroCronometro',
	       	dataType: "json",
	        data:{time:time, time_Bre:time_Bre, time_Entr:time_Entr, time_FBack:time_FBack, time_Bano:time_Bano, time_LLSa:time_LLSa, idUsuario: $('#idUsuario').val(), valorHistoric:valorHistoric, campana:valorCampIniU, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual},
	        success:function(datos){
	        	//alert( 'registroCronometro ==> '+datos.response)  
	        	
	        	if ( datos.response == 'HISTORI') {
	        		//alert('in distinto ' + datos.idRegisHist)
	        		$('#valorIdHistoriSesion').val(datos.idRegisHist)
	        	}
	        	if ( datos.response == 'FIN') {
	        		window.location="?view=session&mode=disconect";
	        	}
	        }
	    })
	    /*$.ajax({
	        type:'POST',
	        url:'?view=contador&mode=registroHistori',
	       	dataType: "json",
	        data:{idUsuario: $('#idUsuario').val(), valorHistoric:valorHistoric},
	        success:function(datos){
	        	//alert(datos.response)
	        	if ( datos.response == 'FIN') {
	        		window.location="?view=session&mode=disconect";
	        	}

	        	if ( datos.response == 'HISTORI') {
	        		//alert('in distinto ' + datos.idRegisHist)
	        		$('#valorIdHistoriSesion').val(datos.idRegisHist)
	        	}
	        }
	    })*/
	},62000);

	//_________________FIN DE SESION_______________________
	$('#buttonFinSesion').click(function(){
		var hour = tiempo.hora
    	var min =  tiempo.minuto
    	var sec = tiempo.segundo
    	var time = hour + ':' + min + ':' + sec

    	var hourBre = tiempo_Bre.hora_Bre
        var minBre =  tiempo_Bre.minuto_Bre
        var secBre = tiempo_Bre.segundo_Bre
        var time_Bre = hourBre + ':' + minBre + ':' + secBre
		
		var hourEntr = tiempo_Entr.hora_Entr
        var minEntr =  tiempo_Entr.minuto_Entr
        var secEntr = tiempo_Entr.segundo_Entr
        var time_Entr = hourEntr + ':' + minEntr + ':' + secEntr
		
		var hourFBack = tiempo_FBack.hora_FBack
        var minFBack =  tiempo_FBack.minuto_FBack
        var secFBack = tiempo_FBack.segundo_FBack
        var time_FBack = hourFBack + ':' + minFBack + ':' + secFBack

		var hourBano = tiempo_Bano.hora_Bano
        var minBano =  tiempo_Bano.minuto_Bano
        var secBano = tiempo_Bano.segundo_Bano
        var time_Bano = hourBano + ':' + minBano + ':' + secBano
		
		var hourLLSa = tiempo_LLSa.hora_LLSa
        var minLLSa =  tiempo_LLSa.minuto_LLSa
        var secLLSa = tiempo_LLSa.segundo_LLSa
        var time_LLSa = hourLLSa + ':' + minLLSa + ':' + secLLSa

        $('#valorTime').val(time)
    	$('#valorTimeBreak').val(time_Bre)
    	$('#valorTimeEntr').val(time_Entr)
    	$('#valorTimeFBack').val(time_FBack)
    	$('#valorTimeBano').val(time_Bano)
    	$('#valorTimeLLSa').val(time_LLSa) 

    	var time_fin 		= $('#valorTime').val();
    	var time_Bre_fin 	= $('#valorTimeBreak').val();
    	var time_Entr_fin 	= $('#valorTimeEntr').val();
    	var time_FBack_fin 	= $('#valorTimeFBack').val(); 
    	var time_Bano_fin 	= $('#valorTimeBano').val();
    	var time_LLSa_fin 	= $('#valorTimeLLSa').val();
    	//_________________datos para la tabla2: cambio de campaña_______________________________
    	var valorCampIniU 		= $('#valorCampanaIniU').val();
    	var valorTimeActual 	= $('#valorTime').val();
		var valorTimeAnterior	= $('#tiempoActual').val();

		var valortimerReady	 		= $('#timerReady_').val(); 
		//alert(time_fin + ' --> '+ time_Bre_fin + ' --> '+ time_Entr_fin + ' --> '+ time_FBack_fin + ' --> '+ time_Bano_fin + ' --> '+ time_LLSa_fin)
		if ( valorTimeAnterior == "" || valorTimeAnterior == 0  || valorTimeAnterior == null) {
			if ( valortimerReady == "" || valortimerReady == 0  || valortimerReady == null) {
				valorTimeAnterior = '00:00:00';
			}else{
				valorTimeAnterior = valortimerReady;
			}
			$('#tiempoAnterior').val(valorTimeAnterior);
			$('#tiempoActual').val(valorTimeActual);
 
		}
	    	$.ajax({
		        type:'POST',
		        url:'?view=contador&mode=registroCronometroFIN',
		       // dataType: "json",
		        data:{time:time_fin, time_Bre:time_Bre_fin, time_Entr:time_Entr_fin, time_FBack:time_FBack_fin, time_Bano:time_Bano_fin, time_LLSa:time_LLSa_fin, idUsuario: $('#idUsuario').val(), campana:valorCampIniU, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual, idHistori:$('#valorIdHistoriSesion').val() },
		        success:function(datos){
		        	//alert(datos)
		        	window.location="?view=session&mode=disconect";
		        }
		    })/**/
    })

    //_________________TIEMPO_READY!!_______________________
    $('#buttonReadyPlay').click(function(){
	    tiempo_corriendo = setInterval(function(){
	        // Segundos
	        tiempo.segundo++;
	        if(tiempo.segundo < 10){ 
	            tiempo.segundo = '0'+tiempo.segundo;
	        }
	        if(tiempo.segundo >= 60){ 
	            tiempo.segundo = 0;
	            tiempo.minuto++;
	            if(tiempo.minuto < 10){ 
		            tiempo.minuto = '0'+tiempo.minuto;
		        }
	        }      
	        // Minutos
	        if(tiempo.minuto >= 60){
	            tiempo.minuto = 0;
	            tiempo.hora++;
	            if(tiempo.hora < 10){ 
		            tiempo.hora = '0'+tiempo.hora;
		        }
	        }
	        
	        $("#hour").text(tiempo.hora);
	        $("#minute").text(tiempo.minuto);
	        $("#second").text(tiempo.segundo);
	    }, 1000);
    })
    $('#buttonReadyPause').click(function(){
    	var hour = tiempo.hora
    	var min =  tiempo.minuto
    	var sec = tiempo.segundo
    	var time = hour + ':' + min + ':' + sec

		clearInterval(tiempo_corriendo);
		$('#valorTime').val(time)
    })

    //_________________BREAK_______________________
    $('#buttonBreakPlay').click(function(){
    	$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',true);
		$('#buttonFBackPlay').attr('disabled',true);   $('#buttonBanoPlay').attr('disabled',true);
		$('#buttonLLSaPlay').attr('disabled',true);
    	$('#buttonBreakPlay').hide()
    	$('#buttonBreakPause').show()
    	$('#bloqueTimeBreak').show();

		$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY
		/*btn-outline-dark */ 
		//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'BR';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,1);
		//______END___________

    	tiempo_corriendo_Bre = setInterval(function(){
		    // Segundos
		    tiempo_Bre.segundo_Bre++;
		    if( tiempo_Bre.segundo_Bre < 10){ 
	            tiempo_Bre.segundo_Bre = '0'+tiempo_Bre.segundo_Bre;
	        }
		    if(tiempo_Bre.segundo_Bre >= 60){
		        tiempo_Bre.segundo_Bre = 0;
		        tiempo_Bre.minuto_Bre++;
		        if(tiempo_Bre.minuto_Bre < 10){ 
		            tiempo_Bre.minuto_Bre = '0'+tiempo_Bre.minuto_Bre;
		        }
		    }      
		    // Minutos
		    if(tiempo_Bre.minuto_Bre >= 60){
		        tiempo_Bre.minuto_Bre = 0;
		        tiempo_Bre.hora_Bre++;
		        if(tiempo_Bre.hora_Bre < 10){ 
		            tiempo_Bre.hora_Bre = '0'+tiempo_Bre.hora_Bre;
		        }
		    }
		 	$("#hour_Bre").text(tiempo_Bre.hora_Bre);
		    $("#minute_Bre").text(tiempo_Bre.minuto_Bre);
		    $("#second_Bre").text(tiempo_Bre.segundo_Bre);
		}, 1000);
    })
    $('#buttonBreakPause').click(function(){
    	$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonBreakPause').hide()
    	$('#bloqueTimeBreak').hide();
    	$('#buttonBreakPlay').show()

    	$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY
    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'BR';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,0);
		//______END___________
    	var hourBre = tiempo_Bre.hora_Bre
        var minBre =  tiempo_Bre.minuto_Bre
        var secBre = tiempo_Bre.segundo_Bre
        var time_Bre = hourBre + ':' + minBre + ':' + secBre

		clearInterval(tiempo_corriendo_Bre);
		$('#valorTimeBreak').val(time_Bre)
    })

    //_________________ENTRENAMIENTO_______________________
    $('#buttonEntrPlay').click(function(){
    	$('#buttonBreakPlay').attr('disabled',true);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',true);   $('#buttonBanoPlay').attr('disabled',true);
		$('#buttonLLSaPlay').attr('disabled',true);
    	$('#buttonEntrPlay').hide()
    	$('#buttonEntrPause').show()
    	$('#bloqueTimeEntr').show();
    	$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'EN';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,1);
		//______END___________
    	tiempo_corriendo_Entr = setInterval(function(){
		    // Segundos
		    tiempo_Entr.segundo_Entr++;
		    if(tiempo_Entr.segundo_Entr < 10){ 
		        tiempo_Entr.segundo_Entr = '0'+tiempo_Entr.segundo_Entr;
		    }
		    if(tiempo_Entr.segundo_Entr >= 60){
		        tiempo_Entr.segundo_Entr = 0;
		        tiempo_Entr.minuto_Entr++;
		        if(tiempo_Entr.minuto_Entr < 10){ 
		            tiempo_Entr.minuto_Entr = '0'+tiempo_Entr.minuto_Entr;
		        }
		    }      
		    // Minutos
		    if(tiempo_Entr.minuto_Entr >= 60){
		        tiempo_Entr.minuto_Entr = 0;
		        tiempo_Entr.hora_Entr++;
		        if(tiempo_Entr.hora_Entr < 10){ 
		            tiempo_Entr.hora_Entr = '0'+tiempo_Entr.hora_Entr;
		        }
		    }
		 	$("#hour_Entr").text(tiempo_Entr.hora_Entr);
		    $("#minute_Entr").text(tiempo_Entr.minuto_Entr);
		    $("#second_Entr").text(tiempo_Entr.segundo_Entr);
		}, 1000);
    })
    $('#buttonEntrPause').click(function(){
		$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonEntrPause').hide()
    	$('#bloqueTimeEntr').hide();
    	$('#buttonEntrPlay').show()
    	$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'EN';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,0);
		//______END___________
    	var hourEntr = tiempo_Entr.hora_Entr
        var minEntr =  tiempo_Entr.minuto_Entr
        var secEntr = tiempo_Entr.segundo_Entr
        var time_Entr = hourEntr + ':' + minEntr + ':' + secEntr

		clearInterval(tiempo_corriendo_Entr);
		$('#valorTimeEntr').val(time_Entr)
    })
    //_________________FEED BACK_______________________
    $('#buttonFBackPlay').click(function(){
    	$('#buttonBreakPlay').attr('disabled',true);  $('#buttonEntrPlay').attr('disabled',true);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',true);
		$('#buttonLLSaPlay').attr('disabled',true);
    	$('#buttonFBackPlay').hide()
    	$('#buttonFBackPause').show()
    	$('#bloqueTimeFBack').show();
    	$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'FB';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,1);
		//______END___________

    	tiempo_corriendo_FBack = setInterval(function(){
		    // Segundos
		    tiempo_FBack.segundo_FBack++;
		    if(tiempo_FBack.segundo_FBack < 10){ 
		        tiempo_FBack.segundo_FBack = '0'+tiempo_FBack.segundo_FBack;
		    }
		    if(tiempo_FBack.segundo_FBack >= 60){
		        tiempo_FBack.segundo_FBack = 0;
		        tiempo_FBack.minuto_FBack++;
		        if(tiempo_FBack.minuto_FBack < 10){ 
			        tiempo_FBack.minuto_FBack = '0'+tiempo_FBack.minuto_FBack;
			    }
		    }      
		    // Minutos
		    if(tiempo_FBack.minuto_FBack >= 60){
		        tiempo_FBack.minuto_FBack = 0;
		        tiempo_FBack.hora_FBack++;
		        if(tiempo_FBack.hora_FBack < 10){ 
			        tiempo_FBack.hora_FBack = '0'+tiempo_FBack.hora_FBack;
			    }
		    }
		 	$("#hour_FBack").text(tiempo_FBack.hora_FBack);
		    $("#minute_FBack").text(tiempo_FBack.minuto_FBack);
		    $("#second_FBack").text(tiempo_FBack.segundo_FBack);
		}, 1000);
    })
    $('#buttonFBackPause').click(function(){
    	$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonFBackPause').hide()
    	$('#bloqueTimeFBack').hide();
    	$('#buttonFBackPlay').show()
    	$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'FB';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,0);
		//______END___________

    	var hourFBack = tiempo_FBack.hora_FBack
        var minFBack =  tiempo_FBack.minuto_FBack
        var secFBack = tiempo_FBack.segundo_FBack 
        var time_FBack = hourFBack + ':' + minFBack + ':' + secFBack

		clearInterval(tiempo_corriendo_FBack);
		$('#valorTimeFBack').val(time_FBack)
    })
    //_________________BAÑO_______________________
    $('#buttonBanoPlay').click(function(){
    	$('#buttonBreakPlay').attr('disabled',true);  $('#buttonEntrPlay').attr('disabled',true);
		$('#buttonFBackPlay').attr('disabled',true);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',true);
    	$('#buttonBanoPlay').hide()
    	$('#buttonBanoPause').show()
    	$('#bloqueTimeBano').show();
    	$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'BA';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,1);
		//______END___________

    	tiempo_corriendo_Bano = setInterval(function(){
		    // Segundos
		    tiempo_Bano.segundo_Bano++;
		    if(tiempo_Bano.segundo_Bano < 10){ 
			    tiempo_Bano.segundo_Bano = '0'+tiempo_Bano.segundo_Bano;
			}
		    if(tiempo_Bano.segundo_Bano >= 60){
		        tiempo_Bano.segundo_Bano = 0;
		        tiempo_Bano.minuto_Bano++;
		        if(tiempo_Bano.minuto_Bano < 10){ 
			        tiempo_Bano.minuto_Bano = '0'+tiempo_Bano.minuto_Bano;
			    }
		    }      
		    // Minutos
		    if(tiempo_Bano.minuto_Bano >= 60){
		        tiempo_Bano.minuto_Bano = 0;
		        tiempo_Bano.hora_Bano++;
		        if(tiempo_Bano.hora_Bano < 10){ 
			        tiempo_Bano.hora_Bano = '0'+tiempo_Bano.hora_Bano;
			    }
		    }
		 	$("#hour_Bano").text(tiempo_Bano.hora_Bano);
		    $("#minute_Bano").text(tiempo_Bano.minuto_Bano);
		    $("#second_Bano").text(tiempo_Bano.segundo_Bano);
		}, 1000);
    })
    $('#buttonBanoPause').click(function(){
    	$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonBanoPause').hide()
    	$('#bloqueTimeBano').hide();
    	$('#buttonBanoPlay').show()
    	$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'BA';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,0);
		//______END___________

    	var hourBano = tiempo_Bano.hora_Bano
        var minBano =  tiempo_Bano.minuto_Bano
        var secBano = tiempo_Bano.segundo_Bano
        var time_Bano = hourBano + ':' + minBano + ':' + secBano

		clearInterval(tiempo_corriendo_Bano);
		$('#valorTimeBano').val(time_Bano)
    })
    //_________________LLAMADAS SALIENTES_______________________
    $('#buttonLLSaPlay').click(function(){
    	$('#buttonBreakPlay').attr('disabled',true);  $('#buttonEntrPlay').attr('disabled',true);
		$('#buttonFBackPlay').attr('disabled',true);   $('#buttonBanoPlay').attr('disabled',true);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonLLSaPlay').hide()
    	$('#buttonLLSaPause').show()
    	$('#bloqueTimeLLSa').show();
    	$('#buttonReadyPause').trigger('click'); //PAUSO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'LL';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,1);
		//______END___________

    	tiempo_corriendo_LLSa = setInterval(function(){
		    // Segundos
		    tiempo_LLSa.segundo_LLSa++;
		    if(tiempo_LLSa.segundo_LLSa < 10){ 
			    tiempo_LLSa.segundo_LLSa = '0'+tiempo_LLSa.segundo_LLSa;
			}

		    if(tiempo_LLSa.segundo_LLSa >= 60){
		        tiempo_LLSa.segundo_LLSa = 0;
		        tiempo_LLSa.minuto_LLSa++;
		        if(tiempo_LLSa.minuto_LLSa < 10){ 
			        tiempo_LLSa.minuto_LLSa = '0'+tiempo_LLSa.minuto_LLSa;
			    }
		    }      
		    // Minutos
		    if(tiempo_LLSa.minuto_LLSa >= 60){
		        tiempo_LLSa.minuto_LLSa = 0;
		        tiempo_LLSa.hora_LLSa++;
		        if(tiempo_LLSa.hora_LLSa < 10){ 
			        tiempo_LLSa.hora_LLSa = '0'+tiempo_LLSa.hora_LLSa;
			    }
		    }
		 	$("#hour_LLSa").text(tiempo_LLSa.hora_LLSa);
		    $("#minute_LLSa").text(tiempo_LLSa.minuto_LLSa);
		    $("#second_LLSa").text(tiempo_LLSa.segundo_LLSa); 
		}, 1000);
    })
    $('#buttonLLSaPause').click(function(){
    	$('#buttonBreakPlay').attr('disabled',false);  $('#buttonEntrPlay').attr('disabled',false);
		$('#buttonFBackPlay').attr('disabled',false);   $('#buttonBanoPlay').attr('disabled',false);
		$('#buttonLLSaPlay').attr('disabled',false);
    	$('#buttonLLSaPause').hide()
    	$('#bloqueTimeLLSa').hide();
    	$('#buttonLLSaPlay').show()
    	$('#buttonReadyPlay').trigger('click');   //INICIO EL TIMER READY

    	//_________CAMBIO DE ESTATUS EN EL AUXILIAR________________
		var auxiliar 	= 'LL';
		var idUsers 	= $('#idUsuario').val();
		cambioStatusAuxiliares(auxiliar,idUsers,0);
		//______END___________

    	var hourLLSa = tiempo_LLSa.hora_LLSa
        var minLLSa =  tiempo_LLSa.minuto_LLSa
        var secLLSa = tiempo_LLSa.segundo_LLSa
        var time_LLSa = hourLLSa + ':' + minLLSa + ':' + secLLSa

		clearInterval(tiempo_corriendo_LLSa);
		$('#valorTimeLLSa').val(time_LLSa)
    })

 
    $('.boton').click(function(){
    	var hour = tiempo.hora
    	var min =  tiempo.minuto
    	var sec = tiempo.segundo
    	var time = hour + ':' + min + ':' + sec

    	var hourBre = tiempo_Bre.hora_Bre
        var minBre =  tiempo_Bre.minuto_Bre
        var secBre = tiempo_Bre.segundo_Bre
        var time_Bre = hourBre + ':' + minBre + ':' + secBre
		
		var hourEntr = tiempo_Entr.hora_Entr
        var minEntr =  tiempo_Entr.minuto_Entr
        var secEntr = tiempo_Entr.segundo_Entr 
        var time_Entr = hourEntr + ':' + minEntr + ':' + secEntr
		
		var hourFBack = tiempo_FBack.hora_FBack
        var minFBack =  tiempo_FBack.minuto_FBack
        var secFBack = tiempo_FBack.segundo_FBack
        var time_FBack = hourFBack + ':' + minFBack + ':' + secFBack

		var hourBano = tiempo_Bano.hora_Bano
        var minBano =  tiempo_Bano.minuto_Bano
        var secBano = tiempo_Bano.segundo_Bano
        var time_Bano = hourBano + ':' + minBano + ':' + secBano
		
		var hourLLSa = tiempo_LLSa.hora_LLSa
        var minLLSa =  tiempo_LLSa.minuto_LLSa
        var secLLSa = tiempo_LLSa.segundo_LLSa
        var time_LLSa = hourLLSa + ':' + minLLSa + ':' + secLLSa

        $('#valorTime').val(time)
    	$('#valorTimeBreak').val(time_Bre)
    	$('#valorTimeEntr').val(time_Entr)
    	$('#valorTimeFBack').val(time_FBack)
    	$('#valorTimeBano').val(time_Bano)
    	$('#valorTimeLLSa').val(time_LLSa)
    	
    	var varCampTemporal = "";
      	var partess = $(this).val().split('?/?');
      	var final = '#buttonCAMPlay'+partess[1]
      	var finalName = partess[0]
      	var finalID = partess[1]

      	var time_fin 		= $('#valorTime').val();
    	var time_Bre_fin 	= $('#valorTimeBreak').val();
    	var time_Entr_fin 	= $('#valorTimeEntr').val();
    	var time_FBack_fin 	= $('#valorTimeFBack').val();
    	var time_Bano_fin 	= $('#valorTimeBano').val();
    	var time_LLSa_fin 	= $('#valorTimeLLSa').val();

      	$('.boton').removeClass('btn-info')
      	$('.boton').removeClass('btn-danger')
      	$('.boton').addClass('btn-dark')
      	$(final).removeClass('btn-dark')
      	$(final).addClass('btn-info')    	    

      	$('#valorCampanaVariable').val(finalName)

      	valorCampIniU 	= $('#valorCampanaIniU').val();
		varCampVariant 	= $('#valorCampanaVariable').val();
		
		//alert('campañaInicialU: ' +valorCampIniU + ' campañaFinal: ' +varCampVariant)

		if ( valorCampIniU == varCampVariant) {
			alert(' -_- deja el OsiO')
			alert(' Pulso el mismo boton, NO se Hace NADA ')
		
		}else{
			$('#valorCampanaAntiguo').val(valorCampIniU);
			$('#valorCampanaIniU').val(varCampVariant);
			$('#valorCampanaVariable').val(finalName);
			//____________________________________________________
			valorCampIniU 	= $('#valorCampanaIniU').val();
			varCampVariant 	= $('#valorCampanaVariable').val();
			varCampAntiguo 	= $('#valorCampanaAntiguo').val();
			//____________________________________________________
			//alert('campañaInicial: ' +varCampIni + ' campañaInicialUNo: ' +valorCampIniU + ' campañaFinal: ' +varCampVariant + ' campañaAntiguo: ' +varCampAntiguo )
			//alert(' Se cambia de valor en la campaña variante, se guarda el timer en la variable anterior y se reinicia CONTADORES ')
			//____________________________________________________
			var valorTimeActual 		= $('#valorTime').val();     	//tiempo 2
			var valorTimeAnterior	 	= $('#tiempoActual').val();		//tiempo 1
			var valortimerReady	 		= $('#timerReady_').val();  	// si tiempo uno esta vacio, pregunto si tiempo_ready esta vacio, para saber si inicio sesion de nuevo o no

			if ( valorTimeAnterior == "" || valorTimeAnterior == 0  || valorTimeAnterior == null) {
				
				if ( valortimerReady == "" || valortimerReady == 0  || valortimerReady == null) {
					valorTimeAnterior = '00:00:00';
				}else{
					valorTimeAnterior = valortimerReady;
				}
				$('#tiempoAnterior').val(valorTimeAnterior);
				$('#tiempoActual').val(valorTimeActual);

				$.ajax({
		            type:'POST',
		            url:'?view=contador&mode=registroPorCambioCampa',
		           // dataType: "json",
		            data:{campana:varCampAntiguo, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual, /*duracion:sumarTime,*/id_usuario:$('#idUsuario').val()/*, id_registro:1*/},
		            success:function(datos){
		            	//alert(datos)
		            }
		        })

			}else{
				$('#tiempoAnterior').val(valorTimeAnterior);
				$('#tiempoActual').val(valorTimeActual);
				
				$.ajax({
		            type:'POST',
		            url:'?view=contador&mode=registroPorCambioCampa',
		           // dataType: "json",
		            data:{campana:varCampAntiguo, hora_inicio:valorTimeAnterior, hora_final:valorTimeActual, /*duracion:sumarTime,*/ id_usuario:$('#idUsuario').val()/*, id_registro:1*/},
		            success:function(datos){
		            	//alert(datos)
		            }
		        })
			}
		}
    });   
})


function cambioStatusAuxiliares(auxi, idUser, status){
	$.ajax({
		type:'POST',
		url:'?view=contador&mode=CambioStatusAuxiliaress',
		// dataType: "json",
		data:{auxiliar:auxi, idUsuario: idUser, estatus: status},
		success:function(datos){
		    //alert(datos)
		}
	})
}