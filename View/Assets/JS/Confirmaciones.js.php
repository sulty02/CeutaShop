function confirmarCerrarSesion(){
  //Mostrar el modal
  var modal = document.getElementById("logoutModal");
  modal.style.display = "block";

  //Confirmar
  var confirmarBtn = document.getElementById("confirmarLogoutBtn");
  confirmarBtn.onclick = function() {
    window.location.href = "Controller/CerrarSesion.php";
  };

  //Cancelar
  var cancelarBtn = document.getElementById("cancelarLogoutBtn");
  cancelarBtn.onclick = function() {
    modal.style.display = "none";
  };
}

function confirmarEliminarProducto(idProducto) {
  //Mostrar el modal
  var modal = document.getElementById("myModal");
  modal.style.display = "block";

  //Confirmar
  var confirmarBtn = document.getElementById("confirmarBtn");
  confirmarBtn.onclick = function() {
    window.location.href = "Controller/EliminarProducto.php?id=" + idProducto;
  };

  //Cancelar
  var cancelarBtn = document.getElementById("cancelarBtn");
  cancelarBtn.onclick = function() {
    modal.style.display = "none";
  };
}

function comprobarSesion(idProducto, idNegocio, unidades){
  var sesionModal = document.getElementById("sesionModal");
  var sesionMensaje = document.getElementById("sesionMensaje");
  var confirmarSesionBtn = document.getElementById("confirmarSesionBtn");

  if(<?php echo isset($_SESSION['usuario']) ? 'true' : 'false'; ?>){
    //La sesión está seteada, redirige a Controller/AniadirAlCarrito.php
    window.location.href = "Controller/AniadirAlCarrito.php?idProducto=" + idProducto + "&idNegocio=" + idNegocio + "&unidades=" + unidades;
  }else{
    //La sesión no está seteada, muestra el modal
    sesionMensaje.innerHTML = "Para añadir un producto al carrito debes iniciar sesión";
    sesionModal.style.display = "block";

    /Función para cerrar el modal
    confirmarSesionBtn.onclick = function(){
      sesionModal.style.display = "none";
    };
  }
}