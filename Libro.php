<?php

class Libro {
    private string $titulo;
    private string $isbn;
    private int $anioPublicacion;
    private string $autor;
    private string $categoria;
    private string $estado;

    public function __construct(string $titulo, string $isbn, int $anioPublicacion, string $autor, string $categoria, string $estado) {
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->anioPublicacion = $anioPublicacion;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getAnioPublicacion(): int {
        return $this->anioPublicacion;
    }

    public function getAutor(): string {
        return $this->autor;
    }

    public function getCategoria(): string {
        return $this->categoria;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function setIsbn(string $isbn): void {
        $this->isbn = $isbn;
    }

    public function setAnioPublicacion(int $anioPublicacion): void {
        $this->anioPublicacion = $anioPublicacion;
    }

    public function setAutor(string $autor): void {
        $this->autor = $autor;
    }

    public function setCategoria(string $categoria): void {
        $this->categoria = $categoria;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }
}
?>
