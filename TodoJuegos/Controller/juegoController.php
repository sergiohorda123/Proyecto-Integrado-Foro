<?php
    require_once("Model/videojuego.php");
    require_once("Model/voto.php");
    require_once("Model/login.php");
    if(isset($_GET['action'])){
        if(isset($_GET['sesion'])){
            session_destroy();
            header("Location:index.php");
        }
        if (isset($_SESSION["usuario"])) {
            if($_GET['action'] == 'index'){
                if (isset($_GET['plataforma'])) {
                    $tamanyo_paginas=6;
                    $pagina=1;
                    if(isset($_GET["pagina"])){
                        $pagina = $_GET["pagina"];
                    }
                    $empezar_desde = ($pagina-1) * $tamanyo_paginas;
                    $juego = new Videojuego($enlaceBD);
                    $plat = $_GET['plataforma'];
                    if(is_numeric($plat)){
                        $juego->Seleccionar("plataforma_juego=$plat");
                        $numeroFilas = $juego->TotalFilasConsulta();
                        $juego->Seleccionar("plataforma_juego=$plat LIMIT $empezar_desde,$tamanyo_paginas");
                        $total_paginas = ceil($numeroFilas / $tamanyo_paginas);
                        if($juego->TotalFilasConsulta() == null || $juego->TotalFilasConsulta() == 0){
                            echo '<h1 class="text-center text-white">Lo sentimos! No existen juegos actualmente para esta categoría</h1>';
                        }else{
                            require_once("View/Videojuego/index.phtml");
                        }
                    }else{
                        echo '<h1 class="text-center text-white">Lo sentimos! No existe esta página</h1>';
                    } 
                }else{
                    $tamanyo_paginas=6;
                    $pagina=1;
                    if(isset($_GET["pagina"])){
                        $pagina = $_GET["pagina"];
                    }
                    $empezar_desde = ($pagina-1) * $tamanyo_paginas;
                    $juego = new Videojuego($enlaceBD);
                    $juego->Seleccionar("1=1");
                    $numeroFilas = $juego->TotalFilasConsulta();
                    $juego->Seleccionar("1=1 LIMIT $empezar_desde,$tamanyo_paginas");
                    $total_paginas = ceil($numeroFilas / $tamanyo_paginas);
                    require_once("View/Videojuego/index.phtml");
                }
            }

            if($_GET['action'] == 'plataforma'){
                require_once("View/Videojuego/plataforma.phtml");
            }

            if($_GET['action'] == 'juego'){
                if(isset($_GET["nomJuego"])){
                    $nombre = $_GET["nomJuego"];
                    $votado = "enabled";
                    $votadoLetra = "Votar";
                    $usuarioVoto = new Login($enlaceBD);
                    $nombreUsuario = $_SESSION["usuario"];
                    $usuarioVoto->Seleccionar("nombre_usuario = '$nombreUsuario'");
                    $usuarioVoto->CargarDatos(0);
                    $idUsuario = $usuarioVoto->getId();
                    $voto = new Voto($enlaceBD,0,$idUsuario,$nombre);
                    $voto->Seleccionar("id_usuario = $idUsuario AND nombre_juego = '$nombre'");
                    if($voto->TotalFilasConsulta() >= 1){
                        $votado = "disabled";
                        $votadoLetra = "Votado!";
                    }
                    if(isset($_GET['voto'])){
                        $voto->Insertar();
                        $juegoVot = new Videojuego($enlaceBD);
                        $juegoVot->Seleccionar("nombre_juego = '$nombre'");
                        $juegoVot->CargarDatos(0);
                        $juegoVot->Votar("nombre_juego = '$nombre'");
                        $votado = "disabled";
                        $votadoLetra = "Votado!";
                    }
                    $juego = new Videojuego($enlaceBD);
                    $juego->Seleccionar("nombre_juego = '$nombre'");
                    
                    require_once("View/Videojuego/juego.phtml");
                }else{
                    echo '<h1 class="text-center text-white">Lo sentimos! No existe esta página</h1>'; 
                }
                
            }

        }
    }else{
        header("Location:index.php?controller=juego&action=index");
    }
?>