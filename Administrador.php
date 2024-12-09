<?php

class Administrador extends Persona {

    public function registrarUser(string $nombre, string $apellido, string $rol, string $usuario, string $password): Usuario {
        // Lógica para registrar un nuevo usuario
        return new Usuario($nombre, $apellido, $rol, $usuario, $password);
    }

    public function gestionarLibros(Biblioteca $biblioteca, Libro $libro, string $accion): void {
        switch ($accion) {
            case 'agregar':
                $this->agregarLibro($biblioteca, $libro);
                break;
            case 'eliminar':
                $this->eliminarLibro($biblioteca, $libro);
                break;
            case 'editar':
                $this->editarLibro($biblioteca, $libro);
                break;
            default:
                throw new InvalidArgumentException("Acción desconocida: $accion");
        }
    }

    private function agregarLibro(Biblioteca $biblioteca, Libro $libro): void {
        $biblioteca->agregarLibro($libro);
    }

    private function eliminarLibro(Biblioteca $biblioteca, Libro $libro): void {
        $biblioteca->eliminarLibro($libro->getIsbn());
    }

    private function editarLibro(Biblioteca $biblioteca, Libro $libro): void {
        $biblioteca->editarLibro($libro->getIsbn(), $libro);
    }

    public function gestionarAutores(Biblioteca $biblioteca, Autor $autor, string $accion): void {
        switch ($accion) {
            case 'agregar':
                $biblioteca->agregarAutor($autor);
                break;
            default:
                throw new InvalidArgumentException("Acción desconocida: $accion");
        }
    }

    public function verInformacionBiblioteca(Biblioteca $biblioteca): string {
        return $biblioteca->verInformacionSistema();
    }
}
?>

