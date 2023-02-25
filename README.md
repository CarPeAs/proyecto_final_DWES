# Programación de una tienda on-line Virtual

## Carateristicas generales del proyecto

Diseño de una aplicación web de tienda virtual programada en lenguaje PHP y MySql para la asignatura de **Desarrollo Web Entorno Servidor (DWES)**.

## Planteamiento práctica final.

### Organización de la página:
En la página principal, aparecé una cabecera con logotipo o imagen de la empresa, y debajo un menú con los apartados Inicio, Conocenos(quienes somos), Catalogo, Pedidos y contacto.

En la zona central de la web para navegar por las distintas categorías, en la que si pinchamos sobre ellas se mostrarán los artículos incluidos en estas.

En la zona superior de la derecha un enlace que nos remite a un formulario para loguearse, o registrarse.

Un pie de página **(Footer)** con las opciones comunes de información sobre la tienda, negocio, textos legales, etc.

La cabecera **(Header)**  y el pie de página **(Footer)** se ven en todo momento se ven en todo momento durante la navegación mediante *includes* y lo que cambia es nuestro “centro” de la página.

Opciones que aparecen en el menú:
- Inicio
- Conocenos
- Pedidos
- Catalogo
- Contactanos

Una vez que el usuario ya se ha logueado, aparecé el nombre del usuario actualmente conectado, junto a un botón de cerrar sesión así como el acceso a sus datos y pedidos.

## Lenguajes de programación usados
Uso de PHP y MySql, así como PHP Data Objects PDO para el acceso a la base de datos para el backend.

Para el frontend uso de Javascript, así como html y css.

## Funcionamiento de la web
### Perfiles usuarios
Logueo (a través de un formulario, en el panel lateral derecho) de usuarios, y el registro, si no están ya registrados.

Se piden su correo electrónico, nombre, contraseña y confirmación de contraseña datos muy básicos para que se registren en nuestra tienda lo más rápido fácilmente posible.

Cuando se “loguean” y han accedido al sistema tienen acceso a opciones de editar sus datos. Adicionalmente ya no aparecerá el formulario de logueo, sino un mensaje con el nombre del usuario, a su vez tiene un botón para cerrar sesión. 

Todas estan opciones estan siempre visible mientras navega el usuario por la web.

La contraseña se guarda encriptada con una función **sha1**.

### Usuario
Navegante o usuario sin registro que simplemente navega por la página sin loguearse. 

El cliente registrado, además podrá:
- Modificar su perfil (email,contraseña).
- Ver/editar sus pedidos (datos del pedido, además del estado de los mismos, etc.)

### Editor
Editor o empleado con acceso a mantenimiento (altas, bajas y modificaciones) de artículos, categorías y pedidos.

### Administrador 
Superusuario, que podrá hacer todo lo que puede hacer el usuario editor, más el mantenimiento de empleados y otros administradores.

## Bajas lógicas
Cuando damos de baja a los usuarios, editores, administradores o articulos, utilizamos una baja logica, es decir en vez de realizar un DELETE se realiza un UPDATE agregando en las determinadas tablas una variables booleana la cual activaremos o desactivaremos a conveniencia para poder visualizar los datos nuevamente.

## Busqueda de artículos
Opcion de búsqueda de artículos para usuarios a través del cuadro de búsqueda que se encuentra en la parte superior derecha de la pantalla.

## Artículos
Navegación por las distintas categorías, visualizándose los artículos de la categoría seleccionada en el centro de la página, incluyendo por cada artículo: imagen, nombre, descripción y precio al menos, así como la opción de añadir a la cesta y cantidad.

## Cesta
La cesta muestra el número de artículos e importe total del carrito y, si pinchamos en él, podemos editarlo, modificarlo, vaciarlo por completo o finalizar compra.