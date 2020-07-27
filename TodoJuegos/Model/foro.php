<?php
    class Foro
    {
        private $enlaceBD;
        private $datosSelect;
        private $id;
        private $id_usuario;
        private $mensaje;
        private $id_foro;
        private $titulo;
        private $descripcion;

        public function __construct($enlaceBD, $vId = null, $vId_usuario = null, $vTitulo = null, $vDescripción = null, $vMensaje = null, $vId_foro = null)
        {
            $this->enlaceBD = $enlaceBD;
            $this->id = $vId;
            $this->id_usuario = $vId_usuario;
            $this->mensaje = $vMensaje;
            $this->id_foro = $vId_foro;
            $this->titulo = $vTitulo;
            $this->descripcion = $vDescripción;
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
        public function setMensaje($mensaje)
        {
            $this->mensaje = $mensaje;
        }
        public function getMensaje()
        {
            return $this->mensaje;
        }
        public function setId_foro($id_foro)
        {
            $this->id_foro = $id_foro;
        }
        public function getId_foro()
        {
            return $this->id_foro;
        }
        public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }
        public function getTitulo()
        {
            return $this->titulo;
        }
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        

        public function CargarDatos($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();

            $this->setId($datosRow["id"]);
            $this->setTitulo($datosRow["titulo"]);
            $this->setDescripcion($datosRow["descripcion"]);
        }

        public function CargarComentarios($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();

            $this->setId($datosRow["id"]);
            $this->setId_usuario($datosRow["id_usuario"]);
            $this->setMensaje($datosRow["mensaje"]);
            $this->setId_foro($datosRow["id_foro"]);
        }

        public function TotalFilasConsulta()
        {
            return $this->datosSelect->num_rows;
        }

        /* Métodos CRUD */
        public function Seleccionar($condiciones = "")
        {
            $query = "SELECT * FROM foro WHERE " . $condiciones;

            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

        public function SeleccionarComentarios($condiciones = "")
        {
            $query = "SELECT * FROM comentario_foro WHERE " . $condiciones;

            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

        public function InsertarComentario(){
            $usu = $this->getId_usuario();
            $men = $this->getMensaje();
            $fot = $this->getId_foro();
            $query = "INSERT INTO comentario_foro VALUES (0,$usu,'$men',$fot)";
            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

    }
?>