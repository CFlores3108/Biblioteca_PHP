<?php

class Usuario extends Persona {

    public function consultarLibro(Biblioteca $biblioteca, string $titulo): ?Libro {
        return $biblioteca->buscarLibro($titulo);
    }

    public function prestarLibro(Biblioteca $biblioteca, Libro $libro): string {
        if ($libro->getEstado() === 'Disponible') {
            $libro->setEstado('Prestado');
            return $this->getNombre() . " ha pedido prestado el libro: " . $libro->getTitulo();
        } else {
            return "Lo siento, el libro " . $libro->getTitulo() . " no está disponible.";
        }
    }

    public function devolverLibro(Biblioteca $biblioteca, Libro $libro): string {
        if ($libro->getEstado() === 'Prestado') {
            $libro->setEstado('Disponible');
            return $this->getNombre() . " ha devuelto el libro: " . $libro->getTitulo();
        } else {
            return "El libro " . $libro->getTitulo() . " no estaba prestado.";
        }
    }

    public function getNombre(): string {
        return $this->nombre;  // Asumiendo que $nombre está definido en la clase Persona
    }
}
?>
