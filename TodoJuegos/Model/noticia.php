<?php
    class Noticia
    {
        private $enlaceBD;
        private $datosSelect;
        private $nombre_noticia;
        private $dia;
        private $mes;
        private $hora;
        private $desc_noticia;
        private $foto;

        public function __construct($enlaceBD, $vNombre_noticia = null, $vDia = null, $vMes = null, $vHora = null, $vDesc_noticia = null, $vFoto = null) 
        {
            $this->enlaceBD = $enlaceBD;
            $this->nombre_noticia = $vNombre_noticia;
            $this->dia = $vDia;
            $this->mes = $vMes;
            $this->hora = $vHora;
            $this->desc_noticia = $vDesc_noticia;
            $this->foto = $vFoto;
        }

        public function setNombre_noticia($nombre_noticia)
        {
            $this->nombre_noticia = $nombre_noticia;
        }
        public function getNombre_noticia()
        {
            return $this->nombre_noticia;
        }
        public function setDia($dia)
        {
            $this->dia = $dia;
        }
        public function getDia()
        {
            return $this->dia;
        }
        public function setMes($mes)
        {
            $this->mes = $mes;
        }
        public function getMes()
        {
            return $this->mes;
        }
        public function setHora($hora)
        {
            $this->hora = $hora;
        }
        public function getHora()
        {
            return $this->hora;
        }
        public function setDesc_noticia($desc_noticia)
        {
            $this->desc_noticia = $desc_noticia;
        }
        public function getDesc_noticia()
        {
            return $this->desc_noticia;
        }
        public function setFoto($foto)
        {
            $this->foto = $foto;
        }
        public function getFoto()
        {
            return $this->foto;
        }

        public function CargarDatos($row)
        {
            mysqli_data_seek($this->datosSelect, $row);
            $datosRow = $this->datosSelect->fetch_assoc();
    
            $this->setNombre_noticia($datosRow["nombre_noticia"]);
            $this->setDia($datosRow["dia"]);
            $this->setMes($datosRow["mes"]);
            $this->setHora($datosRow["hora"]);
            $this->setDesc_noticia($datosRow["desc_noticia"]);
            $this->setFoto($datosRow["foto"]);
        }
    
        public function TotalFilasConsulta()
        {
            return $this->datosSelect->num_rows;
        }

        /* Métodos CRUD */
        public function Seleccionar($condiciones = "")
        {
            $query = "SELECT * FROM noticia WHERE " . $condiciones;
            $this->datosSelect = mysqli_query($this->enlaceBD, $query);
        }
    }
