<?php

class Empleado extends Persona {

    public function gestionarLibros(Biblioteca $biblioteca, Libro $libro, string $accion): void {
        switch ($accion) {
            case 'agregar':
                $this->agregarLibro($biblioteca, $libro);
                break;
            case 'editar':
                $this->editarLibro($biblioteca, $libro);
                break;
            default:
                throw new InvalidArgumentException("Acción desconocida o no permitida: $accion");
        }
    }

    private function agregarLibro(Biblioteca $biblioteca, Libro $libro): void {
        $biblioteca->agregarLibro($libro);
    }

    private function editarLibro(Biblioteca $biblioteca, Libro $libro): void {
        $biblioteca->editarLibro($libro->getIsbn(), $libro);
    }

    public function prestarLibro(Usuario $usuario, Libro $libro): void {
        if ($libro->getEstado() === 'Disponible') {
            $libro->setEstado('Prestado');
            echo $usuario->getNombre() . " ha pedido prestado el libro: " . $libro->getTitulo();
        } else {
            echo "Lo siento, el libro " . $libro->getTitulo() . " no está disponible.";
        }
    }
}
?>
