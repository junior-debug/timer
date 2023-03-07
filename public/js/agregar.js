function mayus(e) {
    e.value = e.value.toUpperCase();
}

var con=0 
function agregarServicios(){
    $('#bloque_service').append('<div id="bloque_service'+con+'"><div class="form-group row center-block"><div class="col-sm-3"><label>Servicio</label></div><div class="col-sm-9"></div><div class="col-sm-3"><input type="text"  required  id="name_servicioAgregar" name="name_servicioAgre[]" class="form-control" onkeyup="mayus(this);"></div><a title="Quitar Servicios" id="quitarServicio" class="btn btn-success btn-sm" onclick="quitarServicio('+con+')" style="margin-left:5px;"><i class="fa fa-minus"></i></a></div></div>')
    con++
} 
        
function quitarServicio(hola){//alert(hola)
    $('#bloque_service'+hola).remove()
}
//_________CAMPAÑA_________
function selectOnchangeService(e){
    if ( $('#servicio_campana') == 0) {
        alert('Debe seleccionar un servicio')
        $('#button_campana').hide();
    }else{
        $('#button_campana').show();
    }
}

var con=0
function agregarCampañas(){
    $('#bloque_campanas').append('<div id="bloque_campanas'+con+'"><div class="form-group row center-block"><div class="col-sm-3"><label><b>Campaña:</b></label></div><div class="col-sm-3"><label><b>Abreviación</b></label></div><div class="col-sm-6"></div><div class="col-sm-3"><input type="text"  required  id="name_campanaAgregar" name="name_campanaAgre[]" class="form-control" onkeyup="mayus(this);"></div><div class="col-sm-3"><input type="text"  required  id="abrev_campanaAgregar" name="abrev_campanaAgre[]" class="form-control" onkeyup="mayus(this);"></div><a title="Quitar campañas" id="quitarCampana" class="btn btn-success btn-sm" onclick="quitarCampana('+con+')" type="button"><span class="fa fa-minus" style="margin-top: 10px;"></span></a></div></div>')
    con++
} //class="form-inline"
        
function quitarCampana(hola){  //alert(hola)
    $('#bloque_campanas'+hola).remove()
}

function guardarCampana(){
    /*document.getElementById('formAgregarCampanas').submit();*/

    var service_campana         = $('#servicio_campana').val()
    var name_campanaAgregar     = $('#name_campanaAgregar').val()
    var abrev_campanaAgregar    = $('#abrev_campanaAgregar').val()

    //alert( service_campana + ' '+ name_campanaAgregar + ' ' + abrev_campanaAgregar )

    if ( service_campana == "" || service_campana == null || service_campana == 0) {
        alert('Existen campos vacíos')
    }
 
} 

function editarCampanass(e){ 
    var url="?view=agregar&mode=editarCampanass&id_campana="+e;
    window.location=url;/**/
}

function editarServicioTabla(e){ 
    var url="?view=agregar&mode=editarServicioos&id_servicio="+e;
    window.location=url;/**/
}

function ModalServicioTabla(e){ 
    $('#valorServicioId').val(e);
}

function NoBorrarServicioTabla(e){ 
    $('#valorServicioId').val("");
}
function SiBorrarServicioTabla(e){ 
    $.post("?view=agregar&mode=borrarServicioss",{id_servicio: $('#valorServicioId').val()},function(r){    
        /*alert(r);*/
        var url="?view=agregar&mode=index_";
        window.location=url;
    })
}

function ModalCampanaTabla(e){ 
    $('#valorCampanaId').val(e);
}

function NoBorrarCampanaTabla(e){ 
    $('#valorCampanaId').val("");
}

function SiBorrarCampanaTabla(e){ 
    $.post("?view=agregar&mode=borrarCampanass",{id_campana: $('#valorCampanaId').val()},function(r){    
        /*alert(r);*/
        var url="?view=agregar&mode=index_";
        window.location=url;
    })
}


function ModalServicioTablaHist(e){ 
    $('#valorServicioIdHist').val(e);
}

function NoBorrarServicioTablaHist(e){ 
    $('#valorServicioIdHist').val("");
}
function SiBorrarServicioTablaHist(e){ 
    $.post("?view=agregar&mode=activarServicioss",{id_servicio: $('#valorServicioIdHist').val()},function(r){    
        /*alert(r);*/
        var url="?view=agregar&mode=index_";
        window.location=url;
    })
}/**/

function ModalCampanaTablaHist(e){ 
    $('#valorCampanaIdHist').val(e);
}

function NoBorrarCampanaTablaHist(e){ 
    $('#valorCampanaIdHist').val("");
}

function SiBorrarCampanaTablaHist(e){ 
    $.post("?view=agregar&mode=activarCampanass",{id_campana: $('#valorCampanaIdHist').val()},function(r){    
        /*alert(r);*/
        var url="?view=agregar&mode=index_";
        window.location=url;
    })
}/**/