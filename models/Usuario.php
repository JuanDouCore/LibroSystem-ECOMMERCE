<?php 

class Usuario {
    private $id;
    private $user;
    private $name;
    private $password;
    private $dni;

    public function __construct($id, $user, $name, $password, $dni)
    {
        $this->id=$id;
        $this->user=$user;
        $this->name=$name;
        $this->password=$password;
        $this->dni=$dni;
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
}
?>