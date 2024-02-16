# Modelos

## BD
- Para conexión con la base de datos (Función estática)

## Producto
- CRUD
- Función estática: 
  - obtenerProductos (clientes)
  - obtenerProductoByID
  - nuevoProducto
  - eliminarProducto
  - actualizarProducto (negocio)

## Usuario
- CRUD 
- Tendrá role para registrar como negocio o usuario

# Controladores

## CRUD_Negocio.php
- Intermediario para CRUD de productos del negocio en específico para su uso en la vista Administración.php. 
- Desde esa vista se recogerá el id del producto y el número de operación mediante GET o solo el número de operación si se va a insertar un nuevo producto.

## CRUD_Usuario.php
- Para dar de alta un usuario, modificar su información o eliminarlo. 
- Así como comprobar sus credenciales para autentificar.

# Vistas

## Assets
- Templates
  - Apertura_Index.php
  - Apertura_Form.php
  - Cierre.php

## CSS
- Index_Cliente.css
- Index_Administracion.css
- Form_Producto.css
- Login.css

## JS
- Cuadro confirmación eliminarproducto
- Reiniciar url editar producto form mostrando mensaje OK
- Cuadro confirmación cerrar sesión

## Productos.php
- Se recogerán los datos de todos los productos del controlador y se mostrarán con un foreach.
- Esta vista será la principal que se incluirá en el index.php si el usuario que ha iniciado sesión es “invitado o role cliente”.

## Administración.php
- Vista principal del index.php en caso de que el usuario de la sesión tenga “role negocio”.
- Tendrá un a href para añadir producto.

# Otras Vistas

## Editar_Producto.php
- Se accederá mediante un a href que llevará el id del producto al controlador y redirigirá a este formulario para editar la información del producto.
- Este form POST redirigirá a la misma vista hasta que se pulse el a href para volver al index.

## Insertar_Producto.php
- Se accederá mediante un a href que llevará el número de operación al controlador y redirigirá a este formulario para insertar un producto.
- Este form POST redirigirá al index.

## Eliminar_Producto.php
- Se accederá mediante un a href que llevará el id del producto y el número de operación al controlador, eliminará el producto y redirigirá al index.php. 
- Podría hacerse un cuadro de confirmación.

## Iniciar_Sesion.php
- Servirá como registro y login.
- Se accederá mediante un a href del index o al intentar añadir un producto al carrito si no se ha iniciado la sesión con un usuario con “role cliente”.

## Index.php
- Tendrá un a href para llevarnos a Iniciar_Sesion.php o a Cerrar_Sesion.php en caso de haber iniciado la sesión con “role cliente o negocio”.

# BASE DE DATOS

- Tabla usuario con id, username, email, teléfono, password.
- Tabla producto con id, nombre, tipo, categorías (color, talla, etc…), precio, idTienda.
- Tabla negocio con id, nombre, email, teléfono, calle, horario.
- Tabla reserva intermediaria entre producto y cliente con idCliente e idProducto.
