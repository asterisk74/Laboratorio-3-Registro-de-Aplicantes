<?php
// Evitar que el archivo sea ejecutado directamente
if (__FILE__ === ($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit("Acceso denegado.");
}
?>

<!--Pie de página-->
<footer class="bg-dark text-white text-center py-4 mt-auto">

    <div class="container">

        <!--Identificación institucional-->
        <p class="mb-1 fw-semibold">
            Portal de Registro de Aspirantes - Universidad Tecnológica de Panamá
        </p>

        <p class="text-white-50 small">
            Carrera: Ciberseguridad
        </p>

        <!--Enlaces de navegación y contacto-->
        <div class="mb-2">

            <a href="index.php" class="text-white text-decoration-none mx-2 small">
                Inicio
            </a>

            |

            <a href="https://utp.ac.pa/" target="_blank" rel="noopener noreferrer"
               class="text-white text-decoration-none mx-2 small">
                Universidad Tecnológica de Panamá
            </a>

            |

            <a href="https://github.com/" target="_blank" rel="noopener noreferrer"
               class="text-white text-decoration-none mx-2 small">
                GitHub
            </a>

            |

            <a href="mailto:soporteTecnico@utp.ac.pa"
               class="text-white text-decoration-none mx-2 small">
                Contacto
            </a>

        </div>

        <!--Derechos de autor-->
        <p class="text-white-50 small mb-0">
            &copy; <?php echo date('Y'); ?>
            Universidad Tecnológica de Panamá.
            Todos los derechos reservados.
        </p>

    </div>

</footer>

</body>
</html>