<?php
    $ZOTGM = simplexml_load_file('../XML/'.$_POST['Archivo'].'');

    $RPEN = $_POST['RPEN'];
    $RPEO = $_POST['RPEO'];
    $NombreO = $_POST['NomO'];
    $CorreoO = $_POST['CorreoO'];
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
        foreach($ZOTGM->usuario as $usuario){
            if($usuario->RPE == $RPEO){
                $usuario->RPE = $RPEN;
                $usuario->Nombre = $NombreN;
                $usuario->Area = $AreaN;
                $usuario->Correo = $CorreoN;
                break;
            }
        }
        file_put_contents('../XML/'.$_POST['Archivo'].'', $ZOTGM->asXML());
    }

    $response = $valido;
    echo json_encode($response);
?>