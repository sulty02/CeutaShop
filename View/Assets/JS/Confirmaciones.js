/*Jorge Muñoz García y Mohamed Abdeselam*/

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

function comprobarSesion(idProducto, idNegocio, unidades, comp){
  var sesionModal = document.getElementById("sesionModal");
  var sesionMensaje = document.getElementById("sesionMensaje");
  var confirmarSesionBtn = document.getElementById("confirmarSesionBtn");

  if(comp == true){
    //La sesión está seteada, redirige a Controller/AniadirAlCarrito.php
    window.location.href = "Controller/AniadirAlCarrito.php?accion=comprar&idProducto=" + idProducto + "&idNegocio=" + idNegocio + "&unidades=" + unidades;
  }

  //La sesión no está seteada, muestra el modal
  sesionMensaje.innerHTML = "Para añadir un producto al carrito debes iniciar sesión";
  sesionModal.style.display = "block";

  confirmarSesionBtn.onclick = function(){
    sesionModal.style.display = "none";
  };
}

function cargarProductos() {
  var searchInput = document.getElementById("search");

  searchInput.addEventListener("input", function () {
    var searchTerm = searchInput.value.trim(); 
    realizarBusqueda(searchTerm);
  });

  realizarBusqueda("");
}

function realizarBusqueda(terminoBusqueda) {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        var contenedor = document.getElementById("productos-container");

        if (!contenedor) {
          contenedor = document.createElement("div");
          contenedor.id = "productos-container";
          contenedor.classList.add("productos-container");

          document.body.appendChild(contenedor);
        }

        contenedor.innerHTML = "";

        contenedor.innerHTML = xhr.responseText;
      } else {
        console.error("Error en la solicitud AJAX");
      }
    }
  };

  xhr.open("GET", "View/Productos.php?search=" + encodeURIComponent(terminoBusqueda), true);
  xhr.send();
}
