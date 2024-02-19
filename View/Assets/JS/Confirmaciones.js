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