$('document').ready(function(){
    var consultaV = "version=1"
    $.ajax({
      type: "POST",
      url: "app/controller/consultaVersion.php",
      data: consultaV
    }).done(function(data){
      var datos = JSON.parse(data); 
      const plataforma = $('#plataforma');
      plataforma.text(datos.data[0].proyecto);

      let admin = $('#administrador');
      admin.text(datos.data[0].administrador);

      let version = $('#version');
      version.text(datos.data[0].version);

      let fechaSubida = $('#fechaVersion');
      fechaSubida.text(datos.data[0].fechaSubida);
    })

  })

  function showBox() {
    let caja = document.getElementById("caja");
    if (caja.style.display === "none") {
      caja.style.display = "block";
    } else {
      caja.style.display = "none";
    }
  }

  function getValue(){
    $('#contenido').on('click', function(){
      let caja = document.getElementById("caja");
      let res = null;
      if(caja.style.display=="none"){
        res = false;
        closeBoxOnOutsideClick(res);
      }else{
        res = true
        closeBoxOnOutsideClick(res);
      }
    })
  }
  getValue()
  function closeBoxOnOutsideClick(res) {

    let caja = document.getElementById('caja');
    if(res==true){
      caja.style.display = "none";
    }else if(res==false){
      caja.style.display = "none";
    }else{
    }
  }