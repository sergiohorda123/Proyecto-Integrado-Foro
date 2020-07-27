<?php
class Login
{
    private $id;
    private $nombre_usuario;
    private $pass;
    private $foto;
    private $rol;
    private $email;
    private $enlaceBD;
    private $datosSelect;

    public function __construct($enlaceBD, $vId = null, $nombre_usuario = null, $pass = null, $foto = null, $rol = null, $email = null)
    {
        $this->enlaceBD = $enlaceBD;
        $this->id = $vId;
        $this->nombre_usuario = $nombre_usuario;
        $this->pass = $pass;
        $this->foto = $foto;
        $this->$rol = $rol;
        $this->email = $email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setNombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }
    public function getNombre_usuario()
    {
        return $this->nombre_usuario;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    public function getPass()
    {
        return $this->pass;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function getFoto()
    {
        return $this->foto;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function CargarDatos($row)
    {

        mysqli_data_seek($this->datosSelect, $row);
        $datosRow = $this->datosSelect->fetch_assoc();

        $this->setId($datosRow["id"]);
        $this->setNombre_usuario($datosRow["nombre_usuario"]);
        $this->setPass($datosRow["pass_usuario"]);
        $this->setFoto($datosRow["foto_usuario"]);
        $this->setRol($datosRow["rol_usuario"]);
        $this->setEmail($datosRow["email"]);
    }

    public function TotalFilasConsulta()
    {
        return $this->datosSelect->num_rows;
    }

    public function ObtenerSiguienteID()
    {

        $query = "SELECT MAX(id) FROM usuario";
        $result = mysqli_query($this->enlaceBD, $query);
        $arrayID = $result->fetch_array();
        $id = $arrayID[0];

        return $id + 1;
    }

    /* CRUD */
    public function Seleccionar($condiciones = "")
    {
        $query = "SELECT * FROM usuario WHERE " . $condiciones;

        $this->datosSelect = mysqli_query($this->enlaceBD, $query);
    }

    public function Insertar()
    {
        $passEncrypt = password_hash($this->pass,PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario VALUES (0,'" . $this->getNombre_usuario() . "','" . $passEncrypt . "',1,'" . $this->getFoto() . "','" . $this->getEmail() . "')";

        $this->datosSelect = mysqli_query($this->enlaceBD, $query);

        if($this->datosSelect=!null){
            echo "<h1>Se ha registrado correctamente</h1>";
        }else {
            echo "<h1>No se ha registrado correctamente</h1>";
        }
    }

    public function Eliminar($condiciones = "")
    {
        $query = "DELETE FROM usuario WHERE " . $condiciones;

        $this->datosSelect = mysqli_query($this->enlaceBD, $query);
    }
}
