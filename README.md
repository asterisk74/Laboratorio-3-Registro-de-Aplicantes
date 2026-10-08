# Laboratorio #3: Sistema de Registro de Aspirantes

## 📋 Descripción del laboratorio

Este repositorio contiene el desarrollo del **Laboratorio #3**, que consiste en crear un sistema web para registrar aspirantes utilizando **HTML5, Bootstrap y PHP**.

El sistema permite ingresar datos personales, seleccionar una fotografía y enviar la información para su validación. El programa comprueba que los campos estén completos, calcula la edad del aspirante y verifica que esté entre **18 y 70 años**. También valida el formato de la fotografía y la guarda en una carpeta protegida del proyecto.

Para este laboratorio **no se utiliza una base de datos**. Las fotografías se guardan en `uploaded_files/` y los demás datos se muestran como resultado del procesamiento del formulario.

## 🎯 Objetivos

- Crear un formulario de registro mediante HTML5 y Bootstrap.
- Organizar la página utilizando las etiquetas semánticas `header`, `main`, `section` y `footer`.
- Reutilizar el encabezado y el pie de página mediante `include` en PHP.
- Recibir la información del formulario utilizando el método `POST`.
- Validar y normalizar los datos ingresados por el aspirante.
- Comprobar que la edad del aspirante esté entre 18 y 70 años.
- Validar, subir y almacenar fotografías de manera segura.
- Evitar el acceso directo a las fotografías desde el navegador.

## 🛠️ Tecnologías y herramientas utilizadas

| Tecnología o herramienta | Uso |
| --- | --- |
| HTML5 | Estructura y campos del formulario. |
| Bootstrap 5.3.8 | Diseño y adaptación de la interfaz a diferentes pantallas. |
| PHP 8.5.0 | Recepción, limpieza y validación de los datos. |
| Apache 2.4 | Ejecución local del sitio y protección de archivos mediante `.htaccess`. |
| WampServer | Entorno de desarrollo local. |
| Visual Studio Code | Edición de los archivos del proyecto. |

## 📁 Estructura del proyecto

```text
Taller-Aspirantes/
├── includes/
│   ├── header.php          # Encabezado, Bootstrap y navegación dinámica
│   └── footer.php          # Pie de página y año dinámico
├── uploaded_files/
│   ├── .htaccess           # Bloquea el acceso directo a las fotografías
│   └── .gitkeep            # Mantiene la carpeta en el repositorio (opcional)
├── imagenes/
│   ├── formulario-registro.png
│   ├── registro-exitoso.png
│   ├── validacion-edad.png
│   └── acceso-denegado.png
├── index.php               # Formulario de registro
├── procesar.php            # Procesamiento y validaciones
├── .gitignore              # Evita publicar las fotografías subidas
└── README.md               # Documentación del laboratorio
```

## ⚙️ Funcionamiento del sistema

1. El aspirante abre `index.php` y completa los campos de **nombre, apellido, identificación, fecha de nacimiento y sexo**.
2. Selecciona una fotografía y presiona **Registrar Aspirante**.
3. El formulario envía los datos a `procesar.php` mediante `POST`, utilizando `enctype="multipart/form-data"` para permitir la subida del archivo.
4. PHP comprueba los campos obligatorios, limpia el texto y normaliza los datos.
5. Se calcula la edad del aspirante a partir de su fecha de nacimiento y se verifica el rango permitido.
6. El sistema verifica que la fotografía tenga un formato admitido y un tamaño máximo de **5 MB**.
7. Si los datos son válidos, la fotografía se guarda con un nombre aleatorio y se muestra el resultado del registro. Si se encuentra algún error, se muestra un mensaje con la causa.

### Validaciones realizadas

| Validación | Comportamiento |
| --- | --- |
| Campos obligatorios | No permite procesar un registro con información faltante. |
| Nombre y apellido | Elimina espacios innecesarios y convierte el texto a formato tipo título. |
| Identificación | Convierte el texto a mayúsculas. |
| Fecha de nacimiento | Comprueba que la fecha sea válida y no sea futura. |
| Edad | Acepta aspirantes de 18 a 70 años. |
| Sexo | Comprueba que la opción enviada sea válida. |
| Fotografía | Acepta JPG, JPEG, PNG, GIF y WEBP, con un máximo de 5 MB. |
| Seguridad de salida | Usa `htmlspecialchars()` al mostrar los datos recibidos. |

## 📸 Capturas de pantalla y resultados

### 1. Formulario de registro

Se muestra el formulario con los campos que debe completar el aspirante y la opción para seleccionar una fotografía.

<img width="811" height="1020" alt="formulario-registro" src="https://github.com/user-attachments/assets/fa1824f3-d530-47ec-a094-3582765ad268" />


### 2. Registro procesado correctamente

Al ingresar datos válidos, el sistema muestra la información del aspirante, su edad calculada y la confirmación de que la fotografía fue guardada.

<img width="871" height="781" alt="registro-exitoso" src="https://github.com/user-attachments/assets/ffc27f44-66d0-4481-a778-307f105f6ef0" />


### 3. Validación de edad

Cuando el aspirante no cumple con el rango establecido de 18 a 70 años, el sistema muestra un mensaje de error y no completa el registro.

<img width="836" height="458" alt="validacion-edad" src="https://github.com/user-attachments/assets/eb034c64-f3dc-44e9-bad9-0a672fc5c743" />


### 4. Protección de la carpeta de fotografías

Se comprueba que Apache devuelve **403 Forbidden** cuando se intenta abrir directamente una fotografía almacenada en `uploaded_files/` desde el navegador.

<img width="722" height="202" alt="acceso-denegado" src="https://github.com/user-attachments/assets/e66f5682-169b-4d44-b030-4b6b0bd41c19" />


## 🔒 Medidas de seguridad

- `trim()` y `strip_tags()` se utilizan para limpiar el texto recibido.
- `htmlspecialchars()` permite mostrar los valores ingresados sin interpretarlos como código HTML.
- El archivo subido se comprueba mediante su extensión, tipo MIME y una validación adicional de imagen.
- Se establece un tamaño máximo de 5 MB para las fotografías.
- Se genera un nombre aleatorio antes de guardar cada fotografía.
- Se utiliza `move_uploaded_file()` para almacenar los archivos recibidos.
- El archivo `uploaded_files/.htaccess` contiene `Require all denied` para impedir el acceso directo por HTTP, siempre que Apache tenga habilitada la aplicación de esa configuración.
- Las fotografías de los aspirantes no deben publicarse en GitHub.

## ▶️ Cómo ejecutar el proyecto

1. Tener instalado y funcionando **WampServer**, con Apache y PHP.
2. Descargar el repositorio y colocar la carpeta `Taller-Aspirantes` dentro de `C:\wamp64\www\`.
3. Verificar que exista la carpeta `uploaded_files/` y que contenga el archivo `.htaccess` con la instrucción:

   ```apache
   Require all denied
   ```

4. Iniciar los servicios de WampServer.
5. Abrir en el navegador la dirección:

   ```text
   http://localhost/Taller-Aspirantes/index.php
   ```

6. Completar el formulario, seleccionar una fotografía y presionar **Registrar Aspirante**.
7. Verificar el resultado en `procesar.php` y comprobar que Apache impida abrir directamente una fotografía guardada.

**Nota:** Bootstrap se carga desde un CDN, por lo que se necesita conexión a Internet para obtener sus estilos. Si Apache muestra las fotografías en lugar de devolver el error 403, es necesario revisar la configuración de `.htaccess` en el servidor.

## 👤 Autor

**Andrés Dommar**  
Universidad Tecnológica de Panamá (UTP)

## 📚 Materiales de apoyo

- *Laboratorio #3*: instrucciones y rúbrica del sistema de registro de aspirantes.
- *Funciones para Incluir Archivos*: uso de `include`, `basename()` y rutas en PHP.
- *Seguridad en las Carpetas*: protección de archivos y directorios con PHP y Apache.
