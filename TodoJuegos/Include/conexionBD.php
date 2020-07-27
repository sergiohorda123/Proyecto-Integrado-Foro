<?php
        define("SERVIDOR", "localhost");
        define("USUARIO", "root");
        define("CONTRASENA", "");
        define("BASEDATOS", "bdforo");

        $enlaceBD = mysqli_connect( SERVIDOR,USUARIO, CONTRASENA, BASEDATOS);

        $enlaceBD->set_charset("utf8");

        if( !$enlaceBD )
        {
            echo "La conexión no se ha podido establecer";
            exit();
        }
?>