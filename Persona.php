<?php

abstract class Persona {
    protected $nombre;
    protected $apellido;
    protected $rol;
    protected $usuario;
    protected $password;

    public function __construct($nombre, $apellido, $rol, $usuario, $password) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->rol = $rol;
        $this->usuario = $usuario;
        $this->password = $password;
    }

    public function getUser() { 
        return $this->usuario; 
    } 
    
    public function getPassword() { 
        return $this->password; 
    } 
    
}
?>