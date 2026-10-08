
<?php
// Incluir el encabezado de la página
include __DIR__ . '/includes/header.php';
?>

<main class="container my-5">

    <section>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-7">

                <h1 class="text-center mb-4">
                    Formulario de Registro de Aspirantes
                </h1>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <form action="procesar.php" method="POST" enctype="multipart/form-data">

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label fw-semibold">
                                    Nombre (Requerido):
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="nombre"
                                       name="nombre"
                                       placeholder="Ingrese su nombre"
                                       required>
                            </div>

                            <!-- Apellido -->
                            <div class="mb-3">
                                <label for="apellido" class="form-label fw-semibold">
                                    Apellido (Requerido):
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="apellido"
                                       name="apellido"
                                       placeholder="Ingrese su apellido"
                                       required>
                            </div>

                            <!-- Identificación -->
                            <div class="mb-3">
                                <label for="identificacion" class="form-label fw-semibold">
                                    Identificación (Requerido):
                                </label>

                                <input type="text"
                                       class="form-control"
                                       id="identificacion"
                                       name="identificacion"
                                       placeholder="Ejemplo: 8-123-456"
                                       required>
                            </div>

                            <!-- Fecha de nacimiento -->
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label fw-semibold">
                                    Fecha de Nacimiento (Requerido):
                                </label>

                                <input type="date"
                                       class="form-control"
                                       id="fechaNacimiento"
                                       name="fechaNacimiento"
                                       aria-describedby="ayudaFecha"
                                       required>

                                <div id="ayudaFecha" class="form-text">
                                    Seleccione su fecha de nacimiento.
                                </div>
                            </div>

                            <!-- Sexo -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Sexo (Requerido):
                                </label>

                                <div class="row g-2">

                                    <div class="col-6">
                                        <input type="radio"
                                               class="btn-check"
                                               name="sexo"
                                               id="hombre"
                                               value="Hombre"
                                               required>

                                        <label class="btn btn-outline-primary w-100"
                                               for="hombre">
                                            Hombre
                                        </label>
                                    </div>

                                    <div class="col-6">
                                        <input type="radio"
                                               class="btn-check"
                                               name="sexo"
                                               id="mujer"
                                               value="Mujer"
                                               required>

                                        <label class="btn btn-outline-primary w-100"
                                               for="mujer">
                                            Mujer
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <!-- Fotografía del aspirante -->
                            <div class="mb-4">

                                <label for="fotografia" class="form-label fw-semibold">
                                    Fotografía del Aspirante (Requerido):
                                </label>

                                <input type="file"
                                       class="form-control"
                                       id="fotografia"
                                       name="fotografia"
                                       accept=".jpg,.jpeg,.png,.gif,.webp"
                                       required>

                                <div class="form-text">
                                    Formatos permitidos: JPG, JPEG, PNG, GIF y WEBP.
                                </div>

                            </div>

                            <!-- Botón de registro -->
                            <div class="d-grid">

                                <button type="submit" class="btn btn-primary btn-lg">
                                    Registrar Aspirante
                                </button>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </section>

</main>

<?php
// Incluir el pie de página
include __DIR__ . '/includes/footer.php';
?>
