function openModalLogin() {
    document.getElementById("login").style.display = "block";
}
function openModalRegister() {
    document.getElementById("register").style.display = "block";
}
function closeModalLogin() {
    document.getElementById("login").style.display = "none";
}
function closeModalRegister() {
    document.getElementById("register").style.display = "none";
}
function redirigir(pagina) {
    window.location.href = pagina;
}

function changeMetodoEnvio() {
    var select = document.getElementById("optionValue");
    var formEnvio = document.getElementById("datosDeEnvioForm");
    var formRetiro = document.getElementById("datosDeCompraForm");

    if (select.value === "aDomicilio") {
        formRetiro.style.display = "none";
        formEnvio.style.display = "block";
    } else {
      formEnvio.style.display = "none";
      formRetiro.style.display = "block";
    }
  }
  