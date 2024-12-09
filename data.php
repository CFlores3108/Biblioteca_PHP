<?php
include 'Libro.php';
include 'Autor.php';
include 'Persona.php';
include 'Usuario.php';
include 'Empleado.php';
include 'Administrador.php';
include 'Biblioteca.php';

// Creación de objetos Libro
$libro1 = new Libro('El Quijote', '978-3-16-148410-0', 1605, 'Miguel de Cervantes', 'Novela', 'Disponible');
$libro2 = new Libro('Cien Años de Soledad', '978-1-56619-909-4', 1967, 'Gabriel García Márquez', 'Novela', 'Disponible');

// Creación de objetos Autor
$autor1 = new Autor('Miguel de Cervantes', 'Española', '1547-09-29');
$autor2 = new Autor('Gabriel García Márquez', 'Colombiana', '1927-03-06');

// Creación de objetos Usuario, Empleado, Administrador
$usuario1 = new Usuario('Juan', 'Pérez', 'jperez', '1234', 'usuario');
$empleado1 = new Empleado('Luis', 'Martínez', 'lmartinez', 'abcd', 'empleado');
$admin1 = new Administrador('Ana', 'Gómez', 'agomez', '5678', 'administrador');

// Creación de objeto Biblioteca
$biblioteca = new Biblioteca(1, 'Biblioteca Central');
$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
$biblioteca->agregarAutor($autor1);
$biblioteca->agregarAutor($autor2);
?>
