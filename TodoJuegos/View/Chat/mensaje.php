<?php
    require_once("/xampp/htdocs/TodoJuegos/Include/conexionBD.php");
    require_once("/xampp/htdocs/TodoJuegos/Model/chat.php");
    $mensaje = new Chat($enlaceBD);
    $mensaje->Seleccionar("1=1 ORDER BY id LIMIT 0,30");
    if ($mensaje->TotalFilasConsulta() > 0) {
        $i = 0;
        while ($i < $mensaje->TotalFilasConsulta()) {
            $mensaje->CargarDatos($i);
            echo "<p><b class='nombre'>" . $mensaje->getNombre_usuario() . "</b> <small>" . $mensaje->getHora_envio() . "</small>: " . $mensaje->getMensaje_usuario() . "</p><hr>";
            $i++;
        }
    } else {
        echo "<h1 class='text-center text-black'>No hay mensajes que mostrar aún</h1>";
    }
?>