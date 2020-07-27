<?php
    class Chat
    {
        private $enlaceBD;
        private $datosSelect;
        private $id;
        private $mensaje_usuario;
        private $hora_envio;
        private $nombre_usuario;
        private $sala;

        public function __construct($enlaceBD, $vId = null, $vMensaje_usuario = null, $vHora_envio = null, $vNombre_usuario = null, $vSala = null) {
            $this->enlaceBD = $enlaceBD;
            $this->id = $vId;
            $this->mensaje_usuario = $vMensaje_usuario;
            $this->hora_envio = $vHora_envio;
            $this->nombre_usuario = $vNombre_usuario;
            $this->sala = $vSala;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setMensaje_usuario($mensaje_usuario)
        {
            $this->mensaje_usuario = $mensaje_usuario;
        }
        public function getMensaje_usuario()
        {
            return $this->mensaje_usuario;
        }
        public function setHora_envio($hora_envio)
        {
            $this->hora_envio = $hora_envio;
        }
        public function getHora_envio()
        {
            return $this->hora_envio;
        }
        public function setNombre_usuario($nombre_usuario)
        {
            $this->nombre_usuario = $nombre_usuario;
        }
        public function getNombre_usuario()
        {
            return $this->nombre_usuario;
        }
        public function setSala($sala)
        {
            $this->sala = $sala;
        }
        public function getSala()
        {
            return $this->sala;
        }

        public function TotalFilasConsulta()
        {
            return $this->datosSelect->num_rows;
        }

        public function CargarDatos($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();

            $this->setId($datosRow["id"]);
            $this->setMensaje_usuario($datosRow["mensaje_usuario"]);
            $this->setHora_envio($datosRow["hora_envio"]);
            $this->setNombre_usuario($datosRow["nombre_usuario"]);
            $this->setSala($datosRow["sala"]);
        }

        /* Métodos CRUD */
        public function Seleccionar($condiciones = "")
        {
            $query = "SELECT * FROM mensajes WHERE " . $condiciones;

            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

        public function Insertar(){
            $mensaje_usuario = $this->getMensaje_usuario();
            $hora_envio = $this->getHora_envio();
            $nombre_usuario = $this->getNombre_usuario();
            $sala = $this->getSala();
            $query = "INSERT INTO mensajes VALUES (0,'$mensaje_usuario','$hora_envio','$nombre_usuario',$sala)";
            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

    }
?>