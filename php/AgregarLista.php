<?php
        $ZOTGM = simplexml_load_file('../XML/'.$_POST['Archivo'].'');
        $RPEN = $_POST['RPEN'];
        $NombreN = $_POST['NomN'];
        $AreaN = $_POST['AreaN'];
        $CorreoN = $_POST['CorreoN'];

        $valido = true;

        foreach($ZOTGM->usuario as $usuario){
                if($RPEN == $usuario->RPE && $RPEN != $RPEO){
                        $valido = false;
                        break;
                }
                if($NombreN == $usuario->Nombre && $NombreN != $NombreO){
                        $valido = false;
                        break;
                }
                if($CorreoN == $usuario->Correo && $CorreoN != $CorreoO){
                        $valido = false;
                        break;
                }
        }
        
        if($valido){
        $usuario = $ZOTGM->addChild('usuario');
        $usuario->addChild('RPE', $RPEN);
        $usuario->addChild('Nombre', $NombreN);
        $usuario->addChild('Area', $AreaN);
        $usuario->addChild('Correo', $CorreoN);

        file_put_contents('../XML/'.$_POST['Archivo'].'', $ZOTGM->asXML());
        }
        $response = $valido;
        echo json_encode($response);
    ?>