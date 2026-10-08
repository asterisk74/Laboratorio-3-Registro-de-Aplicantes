
<?php
// Permitir solamente solicitudes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Arreglo para almacenar los errores
$errores = [];
$registroExitoso = false;
$edad = null;

// Función para limpiar los datos recibidos
function limpiarDato($campo)
{
    $valor = $_POST[$campo] ?? '';

    if (!is_string($valor)) {
        return '';
    }

    return trim(strip_tags($valor));
}

// Función para proteger los datos al mostrarlos
function escapar($texto)
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// Recibir y normalizar los datos del formulario
$nombre = ucwords(strtolower(limpiarDato('nombre')));
$apellido = ucwords(strtolower(limpiarDato('apellido')));
$identificacion = strtoupper(limpiarDato('identificacion'));
$fechaTexto = limpiarDato('fechaNacimiento');
$sexo = limpiarDato('sexo');

// Validar los campos obligatorios
if ($nombre === '') {
    $errores[] = "El nombre es obligatorio.";
}

if ($apellido === '') {
    $errores[] = "El apellido es obligatorio.";
}

if ($identificacion === '') {
    $errores[] = "La identificación es obligatoria.";
}

if (!in_array($sexo, ['Hombre', 'Mujer'], true)) {
    $errores[] = "Debe seleccionar un sexo válido.";
}

// Validar la fecha de nacimiento y calcular la edad
if ($fechaTexto === '') {
    $errores[] = "La fecha de nacimiento es obligatoria.";
} else {

    $fechaNacimiento = DateTimeImmutable::createFromFormat(
        '!Y-m-d',
        $fechaTexto
    );

    if (
        $fechaNacimiento === false ||
        $fechaNacimiento->format('Y-m-d') !== $fechaTexto
    ) {
        $errores[] = "La fecha de nacimiento no es válida.";
    } else {

        $fechaActual = new DateTimeImmutable('today');

        if ($fechaNacimiento > $fechaActual) {
            $errores[] = "La fecha de nacimiento no puede ser futura.";
        } else {

            $edad = $fechaNacimiento->diff($fechaActual)->y;

            if ($edad < 18 || $edad > 70) {
                $errores[] = "La edad permitida es de 18 a 70 años.";
            }
        }
    }
}

// Validar la fotografía
$foto = $_FILES['fotografia'] ?? null;
$extension = '';
$archivoTemporal = '';

if (
    !is_array($foto) ||
    !isset($foto['error']) ||
    $foto['error'] === UPLOAD_ERR_NO_FILE
) {
    $errores[] = "Debe seleccionar una fotografía.";
} elseif ($foto['error'] !== UPLOAD_ERR_OK) {

    $errores[] = "Ocurrió un error al subir la fotografía.";

} elseif (
    !isset($foto['name'], $foto['tmp_name'], $foto['size']) ||
    !is_string($foto['name']) ||
    !is_string($foto['tmp_name']) ||
    !is_uploaded_file($foto['tmp_name'])
) {
    $errores[] = "La fotografía enviada no es válida.";

} else {

    $archivoTemporal = $foto['tmp_name'];

    // Tamaño máximo de 5 MB
    $tamanoMaximo = 5 * 1024 * 1024;

    if ($foto['size'] <= 0 || $foto['size'] > $tamanoMaximo) {
        $errores[] = "La fotografía debe tener un tamaño máximo de 5 MB.";
    }

    // Extensiones y tipos de imagen permitidos
    $tiposPermitidos = [
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp'
    ];

    // Obtener la extensión del archivo
    $extension = strtolower(
        pathinfo($foto['name'], PATHINFO_EXTENSION)
    );

    // Verificar el tipo real del archivo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipoReal = $finfo->file($archivoTemporal);

    if (
        !isset($tiposPermitidos[$extension]) ||
        $tiposPermitidos[$extension] !== $tipoReal ||
        @getimagesize($archivoTemporal) === false
    ) {
        $errores[] = "La fotografía debe ser JPG, JPEG, PNG, GIF o WEBP.";
    }
}

// Guardar la fotografía si no hay errores
if (empty($errores)) {

    $directorioDestino = __DIR__ . '/uploaded_files/';

    // Comprobar que la carpeta exista y tenga permisos
    if (
        !is_dir($directorioDestino) ||
        !is_writable($directorioDestino)
    ) {
        $errores[] = "La carpeta para guardar fotografías no está disponible.";

    } elseif (!is_file($directorioDestino . '.htaccess')) {

        $errores[] = "Falta configurar la protección de la carpeta de fotografías.";

    } else {

        // Generar un nombre aleatorio para la fotografía
        $nombreArchivo = bin2hex(random_bytes(16)) . '.' . $extension;

        $rutaDestino = $directorioDestino . $nombreArchivo;

        // Mover la fotografía a la carpeta del proyecto
        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
            $registroExitoso = true;
        } else {
            $errores[] = "No se pudo guardar la fotografía.";
        }
    }
}

// Incluir el encabezado
include __DIR__ . '/includes/header.php';
?>

<main class="container my-5">

    <section>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <h1 class="text-center mb-4">
                    Resultado del Registro de Aspirantes
                </h1>

                <?php if ($registroExitoso): ?>

                    <!-- Mensaje de registro exitoso -->
                    <div class="alert alert-success" role="alert">
                        El registro del aspirante se ha procesado correctamente.
                    </div>

                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-primary text-white">
                            Datos del Aspirante
                        </div>

                        <div class="card-body">

                            <p>
                                <strong>Nombre:</strong>
                                <?php echo escapar($nombre); ?>
                            </p>

                            <p>
                                <strong>Apellido:</strong>
                                <?php echo escapar($apellido); ?>
                            </p>

                            <p>
                                <strong>Identificación:</strong>
                                <?php echo escapar($identificacion); ?>
                            </p>

                            <p>
                                <strong>Fecha de Nacimiento:</strong>
                                <?php echo escapar($fechaTexto); ?>
                            </p>

                            <p>
                                <strong>Edad:</strong>
                                <?php echo $edad; ?> años
                            </p>

                            <p>
                                <strong>Sexo:</strong>
                                <?php echo escapar($sexo); ?>
                            </p>

                            <p class="mb-0">
                                <strong>Fotografía:</strong>
                                Guardada correctamente.
                            </p>

                        </div>

                    </div>

                <?php else: ?>

                    <!-- Mostrar los errores encontrados -->
                    <div class="alert alert-danger" role="alert">

                        <h4 class="alert-heading">
                            No se pudo completar el registro
                        </h4>

                        <p>Se encontraron los siguientes errores:</p>

                        <ul class="mb-0">

                            <?php foreach ($errores as $error): ?>

                                <li>
                                    <?php echo escapar($error); ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>

                <!-- Botón para regresar al formulario -->
                <div class="text-center mt-4">

                    <a href="index.php" class="btn btn-primary">
                        Volver al Formulario
                    </a>

                </div>

            </div>
        </div>

    </section>

</main>

<?php
// Incluir el pie de página
include __DIR__ . '/includes/footer.php';
?>
