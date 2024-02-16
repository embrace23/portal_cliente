# Portal de emisión de vouchers
Tiene dos funcionalidades para usuarios y para clientes.

## Portal para usuarios

El usuario se busca con nombre, apellido y DNI. Al encontrarlo en la base de datos se descarga el voucher.

## Portal para clientes

El cliente tendrá un usuario y contraseña. Al loguearse se lo redirecciona a su HTML particular donde podrá cargar un archivo CSV que impactará en la base de datos cargando PAXs nuevos.

## Diseños faltantes

1. **usuario.html**
   - [ ] Diseñar la página principal del usuario con los input para buscarse. La paleta de colores sin importancia hasta definir el cliente.

2. **inicio_sesion.html**
     - [ ] Diseñar la página de inicio de sesión con los campos de usuario y contraseña.

3. **clientes1.html**
   - [ ] Diseñar la página donde el cliente podrá cargar el archivo CSV.
   - [ ] Utilizar logos de ejemplo y paleta de colores similares al logo.

4. **HTML final de procesar.php**
   - [ ] Diseñar el HTML que se muestra al final de la ejecución de `procesar.php`.
   - [ ] Incluir un mensaje indicando si el archivo se cargó correctamente.
   - [ ] Agregar un enlace o botón para regresar a la página de clientes.
