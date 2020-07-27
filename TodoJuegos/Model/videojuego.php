<?php
    class Videojuego
    {
        private $enlaceBD;
        private $datosSelect;
        private $nombre_juego;
        private $desc_juego;
        private $num_votos;
        private $punt_total;
        private $foto;
        private $anyo_lanzamiento;
        private $plataforma_juego;

        public function __construct($enlaceBD, $vNombre_juego = null, $vDesc_juego = null, $vNum_votos = null, $vPunt_total = null, $vFoto = null, $vAnyo_lanzamiento = null, $vPlataforma_juego = null)
        {
            $this->enlaceBD = $enlaceBD;
            $this->nombre_juego = $vNombre_juego;
            $this->desc_juego = $vDesc_juego;
            $this->num_votos = $vNum_votos;
            $this->punt_total = $vPunt_total;
            $this->foto = $vFoto;
            $this->anyo_lanzamiento = $vAnyo_lanzamiento;
            $this->plataforma_juego = $vPlataforma_juego;
        }

        public function setNombre_juego($nombre_juego)
        {
            $this->nombre_juego = $nombre_juego;
        }
        public function getNombre_juego()
        {
            return $this->nombre_juego;
        }
        public function setDesc_juego($desc_juego)
        {
            $this->desc_juego = $desc_juego;
        }
        public function getDesc_juego()
        {
            return $this->desc_juego;
        }
        public function setNum_votos($num_votos)
        {
            $this->num_votos = $num_votos;
        }
        public function getNum_votos()
        {
            return $this->num_votos;
        }
        public function setPunt_total($punt_total)
        {
            $this->punt_total = $punt_total;
        }
        public function getPunt_total()
        {
            return $this->punt_total;
        }
        public function setFoto($foto)
        {
            $this->foto = $foto;
        }
        public function getFoto()
        {
            return $this->foto;
        }
        public function setAnyo_lanzamiento($anyo_lanzamiento)
        {
            $this->anyo_lanzamiento = $anyo_lanzamiento;
        }
        public function getAnyo_lanzamiento()
        {
            return $this->anyo_lanzamiento;
        }
        public function setPlataforma_juego($plataforma_juego)
        {
            $this->plataforma_juego = $plataforma_juego;
        }
        public function getPlataforma_juego()
        {
            return $this->plataforma_juego;
        }

        public function CargarDatos($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();

            $this->setNombre_juego($datosRow["nombre_juego"]);
            $this->setDesc_juego($datosRow["desc_juego"]);
            $this->setNum_votos($datosRow["num_votos"]);
            $this->setPunt_total($datosRow["punt_total"]);
            $this->setFoto($datosRow["foto"]);
            $this->setAnyo_lanzamiento($datosRow["anyo_lanzamiento"]);
            $this->setPlataforma_juego($datosRow["plataforma_juego"]);
        }

        public function TotalFilasConsulta()
        {
            return $this->datosSelect->num_rows;
        }

        public function Votar($condiciones = "")
        {
            $totalVotos = $this->getNum_votos() + 1;
            $totalPuntos = $this->getPunt_total() + 10;
            $this->setNum_votos($totalVotos);
            $this->setPunt_total($totalPuntos);
            $query = "UPDATE videojuego set num_votos = $totalVotos, punt_total = $totalPuntos WHERE " . $condiciones;
            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }

        /* Métodos CRUD */
        public function Seleccionar($condiciones = "")
        {
            $query = "SELECT * FROM videojuego WHERE " . $condiciones;

            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }
    }
?>