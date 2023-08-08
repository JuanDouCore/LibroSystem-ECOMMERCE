<?php 

class Usuario {
    private $id;
    private $user;
    private $name;
    private $password;
    private $dni;
    private $rol;

    public function __construct($id, $user, $name, $password, $dni, $rol)
    {
        $this->id=$id;
        $this->user=$user;
        $this->name=$name;
        $this->password=$password;
        $this->dni=$dni;
        $this->rol=$rol;
    }

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getName() {
        return $this->name;
    }

    public function getDni() {
        return $this->dni;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }
}
?>