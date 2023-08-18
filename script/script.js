function calcularHorasExtras() {
    var horaSaida = document.getElementById("horaSaida").value;
    var horasExtras = 0;
  
    if (horaSaida > "17") {
      var horaSaidaArray = horaSaida.split(":");
      var hora = parseInt(horaSaidaArray[0], 10);
      var minutos = parseInt(horaSaidaArray[1], 10);
  
      horasExtras = hora - 17;
  
      if (minutos > 0) {
        horasExtras += minutos / 60;
      }
    }
  
    var horas = Math.floor(horasExtras);
    var minutos = Math.round((horasExtras % 1) * 60);
  
    var horasExtrasFormatadas =
      ("0" + horas).slice(-2) + ":" + ("0" + minutos).slice(-2);
  
    document.getElementById("horasExtras").value = horasExtrasFormatadas;
  }
  