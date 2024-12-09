<?php

class Autor {
    private string $nombre;
    private string $nacionalidad;
    private string $fechaNacimiento;

    public function __construct(string $nombre, string $nacionalidad, string $fechaNacimiento) {
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getNacionalidad(): string {
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad): void {
        $this->nacionalidad = $nacionalidad;
    }

    public function getFechaNacimiento(): string {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function editarAutor(string $nombre, string $apellido, string $nacionalidad, string $fechaNacimiento): void {
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function eliminarAutor(array &$autores): void {
        foreach ($autores as $key => $autor) {
            if ($autor->getNombre() === $this->nombre) {
                unset($autores[$key]);
                break;
            }
        }
    }
}
?>
