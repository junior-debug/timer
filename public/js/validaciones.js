  function mayusculas(e) {
    e.value = e.value.toUpperCase();
  }

  function validaCorreo(e) {
    valueForm=e.value;
    var patron = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)
    if(valueForm.search(patron)!=0){
      alert('La dirección de correo es invalida, el formato debe coincidir con DIRECCION@DOMINIO.COM intente de nuevo.');
      window.location.hash = "#correo";
    }
  }

  function validaTelefono(e) {
    valueForm=e.value
    var patron = /^\d{11}$/;
    if (valueForm.search(patron)!=0){
      alert("El formato del número de telefono debe coincidir con 04241234567. Por favor verifique.");
      return false;
    }
  }

  function soloNumeros(e){
    valueForm = e.value;
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    numero="0123456789*";
    if(numero.indexOf(teclado)==-1){
      alert('Solo se permiten números')
      return false;
    }
  }

  function soloLetras(e) {
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    letras="qwertyuiopasdfghjklñzxcvbnm";
    especiales="32";
    if(letras.indexOf(teclado)==-1 && especiales!=key){
      alert("Solo se permiten letras")
      return false;
    }
  }

  function validaForm(){
    if ($('#d_cliente_efectivo').is(':visible')){
      var nombre          = document.getElementById('nombre').value;
      var apellido        = document.getElementById('apellido').value;
      var cedula          = document.getElementById('cedula').value;
      var telf_hab        = document.getElementById('telf_hab').value;
      var telf_cel        = document.getElementById('telf_cel').value;
      var correo          = document.getElementById('correo').value;
      var patron_tlf      = /^\d{11}$/;
      var patron_correo   = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)
      var patron_nom_ape  = /^([a-z ñáéíóú]{2,60})$/i;
      var coletilla       = ", por favor intente de nuevo.";

      //VALIDO PATRON DE NOMBRE
      if(nombre == ""){
        alert("El campo NOMBRE no puede estar vacio" + coletilla )
        window.location.hash = "#nombre";
        return false;
      }else{
        if (nombre.search(patron_nom_ape)!=0){
          alert("El NOMBRE es invalido "+ nombre + " el formato debe coincidir con PEDRO LUIS ó PEDRO, por favor intente de nuevo" + coletilla);
          window.location.hash = "#nombre";
          return false;
        }
      }
      
      //VALIDO PATRON DE APELLIDO
      if(apellido == ""){
        alert("El campo APELLIDO no puede estar vacio" + coletilla)
        window.location.hash = "#apellido";
        return false;
      }else{
        if (apellido.search(patron_nom_ape)!=0){
        alert("El APELLIDO es invalido "+ apellido + " el formato debe coincidir con LOPEZ CORREA ó LOPEZ" + coletilla);
        window.location.hash = "#apellido";
        return false;
        }
      }

      //VALIDO PATRON DE CEDULA 
      if(cedula == ""){
        alert("El campo CEDULA no puede estar vacio" + coletilla)
        window.location.hash = "#cedula";
        return false;
      }else{
        if (!/^([0-9])*$/.test(cedula)){
        alert("La CÉDULA " + cedula + " debe contener unicamente números" + coletilla);
        window.location.hash = "#cedula";
        return false;
        }
      }

      //VALIDO PATRON DE TELEFONO HABITACION
      if(telf_hab == ""){
        alert("El campo TELÉFONO DOMICILIO no puede estar vacio" + coletilla)
        window.location.hash = "#telf_hab";
        return false;
      }else{
        if (telf_hab.search(patron_tlf)!=0){
          alert("El formato del número de telefono debe coincidir con 04241234567" + coletilla);
          window.location.hash = "#telf_hab";
          return false;
        }
      }

      if(telf_cel == ""){
        alert("El campo TELÉFONO CELULAR no puede estar vacio" + coletilla)
        window.location.hash = "#telf_cel";
        return false;
      }else{
        if (telf_cel.search(patron_tlf)!=0){
          alert("El formato del número de telefono debe coincidir con 04241234567" + coletilla);
          return false;
          window.location.hash = "#telf_cel";
        }
      }

      //VALIDO PATRON DE CORREO
      if(correo == ""){
        alert("El campo CORREO no puede estar vacio" + coletilla)
        return false;
      }else{
        if(correo.search(patron_correo)!=0){
          alert("La dirección de correo es invalida, el formato debe coincidir con DIRECCION@DOMINIO.COM" + coletilla);
          window.location.hash = "#correo";
          return false;
        }
      }
    }
  }