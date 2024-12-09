<?php
include 'data.php';
session_start();

if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = $biblioteca->listarLibros();
}

if (isset($_POST['prestar'])) {
    $isbn = $_POST['isbn'];
    $usuarioNombre = "jperez";

    foreach ($_SESSION['libros'] as &$libro) {
        if ($libro->getIsbn() === $isbn && $libro->getEstado() === 'Disponible') {
            $libro->setEstado('Prestado');
            $mensaje = "$usuarioNombre ha pedido prestado el libro: " . $libro->getTitulo();
            break;
        }
    }
}

if (isset($_POST['agregar'])) {
    $titulo = $_POST['nuevoTitulo'];
    $isbn = $_POST['nuevoIsbn'];
    $anioPublicacion = $_POST['nuevoAnioPublicacion'];
    $autor = $_POST['nuevoAutor'];
    $categoria = $_POST['nuevoCategoria'];
    $nuevoLibro = new Libro($titulo, $isbn, $anioPublicacion, $autor, $categoria, 'Disponible');

    $_SESSION['libros'][] = $nuevoLibro;
    $mensaje = "Nuevo libro agregado: " . $titulo;
}

if (isset($_POST['eliminar'])) {
    $isbn = $_POST['isbn'];
    
    $exito = $biblioteca->eliminarLibro($isbn);
    
    if ($exito) {
        $mensaje = "El libro con ISBN $isbn ha sido eliminado exitosamente.";
    } else {
        $mensaje = "No se pudo eliminar el libro con ISBN $isbn. Puede que no exista.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Biblioteca</h1>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarLibro">
            <strong>+</strong> Agregar Nuevo Libro
        </button>

        <div class="modal fade" id="modalAgregarLibro" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLibroLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregarLibroLabel">Agregar Nuevo Libro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="nuevoTitulo">Título</label>
                                <input type="text" class="form-control" id="nuevoTitulo" name="nuevoTitulo" required>
                            </div>
                            <div class="form-group">
                                <label for="nuevoIsbn">ISBN</label>
                                <input type="text" class="form-control" id="nuevoIsbn" name="nuevoIsbn" required>
                            </div>
                            <div class="form-group">
                                <label for="nuevoAnioPublicacion">Año de Publicación</label>
                                <input type="number" class="form-control" id="nuevoAnioPublicacion" name="nuevoAnioPublicacion" required>
                            </div>
                            <div class="form-group">
                                <label for="nuevoAutor">Autor</label>
                                <input type="text" class="form-control" id="nuevoAutor" name="nuevoAutor" required>
                            </div>
                            <div class="form-group">
                                <label for="nuevoCategoria">Categoría</label>
                                <input type="text" class="form-control" id="nuevoCategoria" name="nuevoCategoria" required>
                            </div>
                            <button type="submit" name="agregar" class="btn btn-success">Agregar Libro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" class="mb-5">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="buscarTitulo">Buscar por Título</label>
                    <input type="text" class="form-control" id="buscarTitulo" name="buscarTitulo" placeholder="Título del libro">
                </div>
                <div class="form-group col-md-4">
                    <label for="buscarAutor">Buscar por Autor</label>
                    <input type="text" class="form-control" id="buscarAutor" name="buscarAutor" placeholder="Nombre del autor">
                </div>
                <div class="form-group col-md-4">
                    <label for="buscarCategoria">Buscar por Categoría</label>
                    <input type="text" class="form-control" id="buscarCategoria" name="buscarCategoria" placeholder="Categoría del libro">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php
        $resultados = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['prestar']) && !isset($_POST['agregar'])) {
            $titulo = strtolower($_POST['buscarTitulo']);
            $autor = strtolower($_POST['buscarAutor']);
            $categoria = strtolower($_POST['buscarCategoria']);

            foreach ($_SESSION['libros'] as $libro) {
                if (
                    $libro->getEstado() === 'Disponible' && 
                    ((!empty($titulo) && strpos(strtolower($libro->getTitulo()), $titulo) !== false) ||
                    (!empty($autor) && strpos(strtolower($libro->getAutor()), $autor) !== false) ||
                    (!empty($categoria) && strpos(strtolower($libro->getCategoria()), $categoria) !== false))
                ) {
                    $resultados[] = $libro;
                }
            }
        }
        ?>

        <?php if (!empty($resultados)): ?>
            <h2 class="text-center">Resultados de la Búsqueda</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $libro): ?>
                        <tr>
                            <td><?= htmlspecialchars($libro->getTitulo()) ?></td>
                            <td><?= htmlspecialchars($libro->getIsbn()) ?></td>
                            <td><?= htmlspecialchars($libro->getAutor()) ?></td>
                            <td><?= htmlspecialchars($libro->getCategoria()) ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($libro->getIsbn()) ?>">
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="isbn" value="<?= htmlspecialchars($libro->getIsbn()) ?>">
                                    <input type="hidden" name="titulo" value="<?= htmlspecialchars($libro->getTitulo()) ?>">
                                    <button type="submit" name="prestar" class="btn btn-primary">Prestar</button><button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?')">Eliminar</button>
                                </form>
                                <a href="detalle_libro.php?isbn=<?= htmlspecialchars($libro->getIsbn()) ?>" class="btn btn-info">Ver Detalle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No hay libros disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>
