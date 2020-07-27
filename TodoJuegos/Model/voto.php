<?php
    class Voto
    {
        private $enlaceBD;
        private $datosSelect;
        private $id;
        private $id_usuario;
        private $nombre_juego;

        public function __construct($enlaceBD, $vId = null, $vId_usuario = null, $vNombre_juego = null) {
            $this->enlaceBD = $enlaceBD;
            $this->id = $vId;
            $this->id_usuario = $vId_usuario;
            $this->nombre_juego = $vNombre_juego;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setId_usuario($id_usuario)
        {
            $this->id_usuario = $id_usuario;
        }
        public function getId_usuario()
        {
            return $this->id_usuario;
        }
        public function setNombre_juego($nombre_juego)
        {
            $this->nombre_juego = $nombre_juego;
        }
        public function getNombre_juego()
        {
            return $this->nombre_juego;
        }
        
        public function CargarDatos($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();

            $this->setId($datosRow["id"]);
            $this->setId_usuario($datosRow["id_usuario"]);
            $this->setNombre_juego($datosRow["nombre_juego"]);
        }

        public function TotalFilasConsulta()
        {
            return $this->datosSelect->num_rows;
        }

        /* CRUD */
        public function Seleccionar($condiciones = "")
        {
            $query = "SELECT * FROM voto WHERE " . $condiciones;

            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

        public function Insertar(){
            $usu = $this->getId_usuario();
            $jue = $this->getNombre_juego();
            $query = "INSERT INTO voto VALUES (0,$usu,'$jue')";
            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

    }
    
?>