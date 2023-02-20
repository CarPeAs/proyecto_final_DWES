# Programación de una tienda on-line Virtual

## Carateristicas generales del proyecto

Diseño de una aplicación web de tienda virtual programada en lenguaje PHP y MySql para la asignatura de **Desarrollo Web Entorno Servidor (DWES)**.

## PHP
Use de PHP Data Objects PDO para el acceso a la base de datos.

## Funcionamiento de la web
### Perfiles usuarios
Logueo (a través de un formulario, en el panel lateral derecho) de usuarios, y el registro, si no están ya registrados.

Se piden su correo electrónico, nombre, contraseña y confirmación de contraseña datos muy básicos para que se registren en nuestra tienda lo más rápido fácilmente posible.

Cuando se “loguean” y han accedido al sistema tienen acceso a opciones de editar sus datos. Adicionalmente ya no aparecerá el formulario de logueo, sino un mensaje con el nombre del usuario, a su vez tiene un botón para cerrar sesión. 

Todas estan opciones estan siempre visible mientras navega el usuario por la web.

La contraseña se guarda encriptada con una función **sha1**.