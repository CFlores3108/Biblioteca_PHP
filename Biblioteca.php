<?php

class Biblioteca {
    private int $id;
    private string $descripcion;
    private array $libros = [];
    private array $autores = [];

    // Constructor
    public function __construct(int $id, string $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function agregarLibro(Libro $libro): void {
        $this->libros[] = $libro;
    }

    public function editarLibro(string $isbn, Libro $nuevoLibro): bool {
        foreach ($this->libros as &$libro) {
            if ($libro->getIsbn() === $isbn) {
                $libro = $nuevoLibro;
                return true;
            }
        }
        return false;
    }

    public function eliminarLibro(string $isbn): bool {
        foreach ($this->libros as $index => $libro) {
            if ($libro->getIsbn() === $isbn) {
                unset($this->libros[$index]);
                $this->libros = array_values($this->libros);  // Reindexar array
                return true;
            }
        }
        return false;
    }

    public function buscarLibro(string $titulo): ?Libro {
        foreach ($this->libros as $libro) {
            if (strtolower($libro->getTitulo()) === strtolower($titulo)) {
                return $libro;
            }
        }
        return null;  // No se encuentra el libro
    }

    public function buscarLibrosPorAutor(string $autor): array {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (strtolower($libro->getAutor()) === strtolower($autor)) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    public function buscarLibrosPorCategoria(string $categoria): array {
        $resultados = [];
        foreach ($this->libros as $libro) {
            if (strtolower($libro->getCategoria()) === strtolower($categoria)) {
                $resultados[] = $libro;
            }
        }
        return $resultados;
    }

    public function listarLibros(): array {
        return $this->libros;
    }

    public function agregarAutor(Autor $autor): void {
        $this->autores[] = $autor;
    }

    public function verInformacionSistema(): string {
        return "Libros: " . count($this->libros) . " | Autores: " . count($this->autores);
    }
}
?>
