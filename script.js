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
function closeModalAviso() {
    document.getElementById("test-a").style.display = "none";
}
function redirigir(pagina) {
    window.location.href = pagina;
}
function changeBusquedaUsuarios() {
    var select = document.getElementById("optionBusquedaUsuarios");
    var todos = document.getElementById("divBusquedaAll");
    var clientes = document.getElementById("divBusquedaClientes");
    var empleados = document.getElementById("divBusquedaEmpleados");


    if (select.value === "todos") {
        clientes.style.display = "none";
        empleados.style.display = "none";
        todos.style.display = "block";
    } else if (select.value === "clientes"){
        todos.style.display = "none";
        empleados.style.display = "none";
        clientes.style.display = "block";
    } else {
        todos.style.display = "none";
        clientes.style.display = "none";
        empleados.style.display = "block";
    }
  }
  
function changeMetodoEnvio() {
    var select = document.getElementById("optionValue");
    var formEnvio = document.getElementById("datosDeEnvioForm");
    var formRetiro = document.getElementById("datosDeCompraForm");


    if (select.value === "aDomicilio") {
        formRetiro.style.display = "none";
        formEnvio.style.display = "flex";
    } else {
      formEnvio.style.display = "none";
      formRetiro.style.display = "flex";
    }
  }



  